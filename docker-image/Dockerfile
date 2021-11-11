FROM orangehrm/orangehrm-db-images:mariadb-10.5-redhat-8.4-base

VOLUME /var/lib/mysql

COPY config/server.cnf /etc/my.cnf.d/server.cnf

# Disable GSSAPI plugin, since Kerberos authentication is not required 
RUN echo "" > /etc/my.cnf.d/auth_gssapi.cnf

# Clean MariaDB data directory
RUN rm -rf /var/lib/mysql/*

COPY entrypoint.sh /usr/local/bin/
RUN ln -s /usr/local/bin/entrypoint.sh /
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]

EXPOSE 3306

CMD ["mysqld_safe"]