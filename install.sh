#!/bin/bash 

## Find the present directory
PWD=$(pwd)

## Sourcing the common variables
source "$PWD/config/chat.cfg"


## Validate whether port 80 and 443 is open
echo "# ******************************************************************* #"
echo "  validate whether port 80 and 443 is open ";
echo "# ******************************************************************* #"
ISPORTOPEN=$(netstat -anp |grep -E ':80 |:443 '|grep LISTEN);

if [ -n "$ISPORTOPEN" ]; then
    echo "Another process is running on Port 80/443!! Please stop the following pid's before installing the same";
    echo $ISPORTOPEN;
    exit 1;
else
    echo "Port 80 and 443 is open!! Proceeding....!!!"
fi

## Validate whether Docker is running or not.
echo "# ******************************************************************* #"
echo "  validate whether docker is running or not ";
echo "# ******************************************************************* #"

ps -ef | grep docker | grep -v grep
if [ $?  -eq "0" ]; then
   echo "Docker process is running, continue....."
else
   echo "Docker process is not running, please start the process before executing...."
   exit 1
fi


## Check the container is already exists or not
echo "# ******************************************************************* #"
echo "  checking the Docker images are exists or not";
echo "# ******************************************************************* #"

for image in $APACHECONTAINER $MYSQLCONTAINER $MAVENCONTAINER
do
	imageid=$(docker images | grep $image | awk {'print $3'})
        if [ -n "$imageid" ]; then
             echo " container $image already exists, removing..... "
	     echo " Check container is running....";
            
             ## Find container id which are running... stop if it is running 
             containerid=$(docker ps | grep $image | awk {'print $1'}) 
	     if [ -n "$containerid" ]; then
                echo "$containerid is running.... !! stopping...."
	     	docker stop $(docker ps | grep $image | awk {'print $1'})
             fi

             ## Remove the stopped containers.
             stoppedcontainerid=$(docker ps -a| grep $image | awk {'print $1'})
 
             if [ -n "$stoppedcontainerid" ]; then
		echo "removing the containers $stoppedcontainerid....."
		docker rm $(docker ps -a| grep $image | awk {'print $1'})
             fi
             
	     ## Remove the docker images
             docker rmi $imageid
        fi
	
done

## Create mysql container;
echo "# ******************************************************************* #"
echo "  create mysql container  and start it";
echo "# ******************************************************************* #"
cd mysql
docker build -t "$MYSQLCONTAINER:$CONTAINERVERSION" .

## Start mysql container
docker run -d  --name mysqlserver  $MYSQLCONTAINER:$CONTAINERVERSION


## Create apache container

echo "# ******************************************************************* #"
echo "  create apache container and start it; expose port 80 and 443; link mysql container ";
echo "# ******************************************************************* #"
cd ../apache
docker build -t "$APACHECONTAINER:$CONTAINERVERSION" .

## Start apache container; expose port 80 and 443; link mysql container
docker run -d -p 80:80 -p 443:443 --name apache --link mysqlserver:mysqldb $APACHECONTAINER:$CONTAINERVERSION


echo "# ******************************************************************* #"
echo "  create maven container";
echo "# ******************************************************************* #"
cd ../maven
docker build -t "$MAVENCONTAINER:$CONTAINERVERSION" .


echo "# ******************************************************************* #"
echo "  Deploy the application ";
echo "# ******************************************************************* #"

## Cd to database directory
cd ../database

## Deploy mysql 
./mysql_deploy.sh

## Cd to php directory
cd ../php

## Invoke PHP build
./php_build.sh

## Deply PHP applicaiton 
./php_deploy.sh
