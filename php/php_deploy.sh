#!/bin/bash

## Find the present directory
PWD=$(pwd)

## Sourcing the common variables
source "$PWD/../config/chat.cfg"


## Find apache container id
apacheconid=$( docker ps | grep $APACHECONTAINER:$CONTAINERVERSION | awk '{print $1}' );

echo "# ******************************************************************* #"
echo "  Copy the tar file to Docker container ";
echo "# ******************************************************************* #"

## Finding the tar file in target folder
tarfile=$(find target/ -name *.tar | awk -F/ '{print $2}')

## Copy the tar file and extract
docker cp target/$tarfile $apacheconid:/tmp
docker exec -it $apacheconid tar -xvf /tmp/$tarfile -C /var/www/html/

echo "# ******************************************************************* #"
echo " Invoking the test scripts  ";
echo "# ******************************************************************* #"

docker exec -it $apacheconid chmod +x /var/www/html/unittest/unitTest.sh
docker exec -it $apacheconid /var/www/html/unittest/unitTest.sh
