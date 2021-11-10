#!/bin/bash
set -e

if [ "${1:0:1}" = '-' ]; then
	set -- mysqld_safe "$@"
fi

if [ "$1" = 'mysqld_safe' ]; then
	DATADIR="/var/lib/mysql"

	
	# Create MariaDB log file if not exists
	touch /var/log/mariadb/mariadb.log
	chown mysql:root /var/log/mariadb/mariadb.log
	chmod 770 /var/log/mariadb/mariadb.log

	if [ -z "$MYSQL_ROOT_PASSWORD" -a -z "$MYSQL_ALLOW_EMPTY_PASSWORD" ]; then
		echo >&2 'error: database is uninitialized and MYSQL_ROOT_PASSWORD not set'
		echo >&2 '  Did you forget to add -e MYSQL_ROOT_PASSWORD=... ?'
		exit 1
	fi
	
	echo 'Running mysql_install_db ...'
	# Refresh MariaDB installation
	mysql_install_db --user=mysql --basedir=/usr --datadir=/var/lib/mysql
	echo 'Finished mysql_install_db'
	
	if [ ! -f "/var/lib/mysql/INNODB_CLEANED" ]; then	
		rm -f /var/lib/mysql/ib_logfile*
		rm -f /var/lib/mysql/ibdata*
		echo "INNODB_CLEANED" >> /var/lib/mysql/INNODB_CLEANED
	fi
	
	# These statements _must_ be on individual lines, and _must_ end with
	# semicolons (no line breaks or comments are permitted).
	# TODO proper SQL escaping on ALL the things D:
	
	tempSqlInitFile='/tmp/mysql-init-file.sql'
	cat > "$tempSqlInitFile" <<-EOSQL
		DELETE FROM mysql.user WHERE User='root' AND Host !='%' ;
		DELETE FROM mysql.user WHERE User='' ;
		CREATE USER IF NOT EXISTS 'root'@'%' IDENTIFIED BY '${MYSQL_ROOT_PASSWORD}' ;
		ALTER USER 'root'@'%' IDENTIFIED BY '${MYSQL_ROOT_PASSWORD}' ;
		GRANT ALL ON *.* TO 'root'@'%' WITH GRANT OPTION ;
		DROP DATABASE IF EXISTS test ;
	EOSQL
	
	if [ "$MYSQL_DATABASE" ]; then
		echo "CREATE DATABASE IF NOT EXISTS \`$MYSQL_DATABASE\` ;" >> "$tempSqlInitFile"
		if [ "$MYSQL_CHARSET" ]; then
			echo "ALTER DATABASE \`$MYSQL_DATABASE\` CHARACTER SET \`$MYSQL_CHARSET\` ;" >> "$tempSqlInitFile"
		fi
		
		if [ "$MYSQL_COLLATION" ]; then
			echo "ALTER DATABASE \`$MYSQL_DATABASE\` COLLATE \`$MYSQL_COLLATION\` ;" >> "$tempSqlInitFile"
		fi
	fi
	
	if [ "$MYSQL_USER" -a "$MYSQL_PASSWORD" ]; then
		echo "CREATE USER '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD' ;" >> "$tempSqlInitFile"
		
		if [ "$MYSQL_DATABASE" ]; then
			echo "GRANT ALL ON \`$MYSQL_DATABASE\`.* TO '$MYSQL_USER'@'%' ;" >> "$tempSqlInitFile"
		fi
	fi
	
	echo 'FLUSH PRIVILEGES ;' >> "$tempSqlInitFile"
	
	set -- "$@" --init-file="$tempSqlInitFile"	
fi

exec "$@"