FROM ubuntu:14.04
MAINTAINER binojnnair@in.ibm.com

RUN apt-get update -qq
RUN apt-get upgrade -y

RUN apt-get install -y apache2 php5 php5-cli libapache2-mod-php5 php5-gd php5-json php5-ldap php5-mysql php5-pgsql

RUN a2enmod ssl
RUN a2ensite default-ssl

RUN rm -f /var/www/html/index.html

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

EXPOSE 80 443
