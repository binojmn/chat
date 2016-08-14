#!/bin/bash

## Sourcing the common variables
source ../config/chat.cfg

## Find current path
currentdir=$(pwd)

## Invoke build
docker run -it -v $currentdir:/php/code/ $MAVENCONTAINER:$CONTAINERVERSION /php/code/build.sh

