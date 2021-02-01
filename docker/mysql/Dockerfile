FROM mysql:8.0

ENV TZ=UTC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

COPY ./conf.d/logging.cnf /etc/mysql/conf.d/logging.cnf
COPY ./conf.d/innodb.cnf /etc/mysql/conf.d/innodb.cnf
COPY ./sql-scripts/ /docker-entrypoint-initdb.d/
