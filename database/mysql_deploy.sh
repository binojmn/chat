#!/bin/bash

## Find the present directory
PWD=$(pwd)

## Sourcing the common variables
source "$PWD/../config/chat.cfg"

## Find mysql container
mysqlconid=$( docker ps | grep $MYSQLCONTAINER:$CONTAINERVERSION | awk '{print $1}' );

## Copy the files to mysql container.
docker cp sql/chat.sh $mysqlconid:/tmp
docker cp sql/chat.sql $mysqlconid:/tmp

## Create tables
sleep 10
docker exec -it $mysqlconid chmod +x /tmp/chat.sh
docker exec -it $mysqlconid  /tmp/chat.sh

