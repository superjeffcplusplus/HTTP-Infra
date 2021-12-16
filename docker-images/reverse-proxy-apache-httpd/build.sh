#!/bin/bash

# This script kills the php container if running and rebuilds it
docker kill api/apache_rp 2>/dev/null;
docker rm api/apache_rp 2>/dev/null;
docker image rm api/apache_rp 2>/dev/null;

docker build -t api/apache_rp . ;