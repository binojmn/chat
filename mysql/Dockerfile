FROM ubuntu:14.04
MAINTAINER binojnnair@in.ibm.com
ENV DEBIAN_FRONTEND noninteractive 

RUN apt-get update -qq
RUN apt-get -y upgrade
RUN apt-get -y install mysql-client mysql-server

#binding all interfaces
RUN sed -i -e"s/^bind-address\s*=\s*127.0.0.1/bind-address = 0.0.0.0/" /etc/mysql/my.cnf

ADD mysql_run.sh /mysql_run.sh

EXPOSE 3306

CMD ["/bin/bash","/mysql_run.sh"]
