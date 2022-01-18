#!/bin/bash
# arrête le container 
echo "Killing container... "
docker kill http-dynamic 2>/dev/null;
# supprime le container
echo "Removing container... "
docker rm http-dynamic 2>/dev/null;
# créée l'image
echo "Building image... "
docker build -t api/http-dynamic . ;
# lance un container
docker run -d \
        -p 1234:3000 \
        --name api-web-dynamic-dev \
        --mount type=bind,src="$(pwd)/src",target=/var/www/html/ \
        api/http-dynamic;