#!/bin/bash

# This script kills the php container if running and rebuilds it
docker kill http-infra 2>/dev/null;
docker rm http-infra 2>/dev/null;
docker image rm api/http-infra 2>/dev/null;

docker build -t api/http-infra . ;