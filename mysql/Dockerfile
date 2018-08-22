FROM mysql:5.6
MAINTAINER NLTGis admin@nltgis.com


# convert links to the prod server to be links to the test server
COPY db_data/ccb-disasters-8-17-18.sql /tmp/ccb-disasters-8-17-18.sql
RUN cat /tmp/ccb-disasters-8-17-18.sql  | sed -e 's/https:\/\/communities.geoplatform.gov\/disasters\//http:\/\/localhost\/test_site\//' > /tmp/dump.sql

# restore the prod db
RUN /bin/bash -c "/usr/bin/mysqld_safe --skip-grant-tables &" && \
  sleep 5 && \
  mysql -u root -e "CREATE DATABASE wordpress" && \
  mysql -u root -D wordpress < /tmp/dump.sql && \
  rm /tmp/dump.sql /tmp/ccb-disasters-8-17-18.sql && \
  more /var/lib/mysql/*err


