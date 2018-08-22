FROM mysql:5.6
MAINTAINER NLTGis admin@nltgis.com

# restore the prod db
RUN /bin/bash -c "/usr/bin/mysqld_safe --skip-grant-tables &" && \
  sleep 5 && \
  mysql -u root -e "CREATE DATABASE mydbx" && \
  mysql -u root mydbx < /tmp/db_data/dump.sql


