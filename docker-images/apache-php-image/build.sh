#!/bin/bash

# This script kills the php container if running and rebuilds it
docker kill php 2>/dev/null;
docker rm php 2>/dev/null;
docker image rm api/php 2>/dev/null;

docker build -t api/php . ;