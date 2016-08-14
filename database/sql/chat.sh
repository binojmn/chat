#!/bin/sh

# create chat tables;
mysql -uibm_chat_user -pibm_chat_pass ibm_chat_db < /tmp/chat.sql
