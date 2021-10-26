FROM centos:7

COPY config/mariadb.repo /etc/yum.repos.d/
RUN yum install -y MariaDB-server

VOLUME /var/lib/mysql
COPY config/server.cnf /etc/my.cnf.d/server.cnf

COPY entrypoint.sh /usr/local/bin/
RUN ln -s /usr/local/bin/entrypoint.sh /
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]

EXPOSE 3306

CMD ["mysqld_safe"]