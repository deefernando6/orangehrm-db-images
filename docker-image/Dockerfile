FROM centos:7

#RUN groupadd -r mysql && useradd -r -g mysql mysql

COPY mariadb.repo /etc/yum.repos.d/
RUN yum install -y MariaDB-server

# # Install gosu.  https://github.com/tianon/gosu
# ENV GOSU_VERSION=1.14
# RUN gpg --batch --keyserver hkps://keys.openpgp.org --recv-keys B42F6819007F00F88E364FD4036A9C25BF357DD4 \
#     && curl -o /usr/local/bin/gosu -SL "https://github.com/tianon/gosu/releases/download/${GOSU_VERSION}/gosu-amd64" \
#     && curl -o /usr/local/bin/gosu.asc -SL "https://github.com/tianon/gosu/releases/download/${GOSU_VERSION}/gosu-amd64.asc" \
#     && gpg --verify /usr/local/bin/gosu.asc \
#     && rm -rf /usr/local/bin/gosu.asc \
#     && rm -rf /root/.gnupg/ \
#     && chmod +x /usr/local/bin/gosu

#RUN rm -rf /var/lib/mysql/*

VOLUME /var/lib/mysql

COPY entrypoint.sh /usr/local/bin/
RUN ln -s /usr/local/bin/entrypoint.sh /
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]

EXPOSE 3306

CMD ["mysqld_safe"]