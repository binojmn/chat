#/bin/sh

## Start mysql
/usr/sbin/mysqld &
sleep 5

## Create the CHAT database and user
mysql -uroot -e "CREATE DATABASE ibm_chat_db"
mysql -uroot -e "CREATE USER 'ibm_chat_user'@'%' IDENTIFIED BY 'ibm_chat_pass';"
mysql -uroot -e "GRANT ALL ON ibm_chat_db.* TO 'ibm_chat_user'@'%';"
mysql -uroot -e "FLUSH PRIVILEGES;"

## Stop and restart mysql
mysqladmin shutdown
/usr/sbin/mysqld
