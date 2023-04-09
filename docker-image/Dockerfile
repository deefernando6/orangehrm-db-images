FROM redhat/ubi8:8.6
LABEL authors = "OrangeHRM TechOps <techops@orangehrm.com>"

ARG REDHAT_USERNAME
ARG REDHAT_PASSWORD

VOLUME /var/lib/mysql

# Register a system with the Red Hat Customer Portal
RUN subscription-manager register --username $REDHAT_USERNAME --password $REDHAT_PASSWORD && \
subscription-manager refresh

RUN yum module install mariadb:10.5/server -y

RUN subscription-manager unregister

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
