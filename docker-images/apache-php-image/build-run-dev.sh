#!/bin/bash
# arrête le container 
echo "Killing container... "
docker container kill api-web-static-dev 2>/dev/null;
# supprime le container
echo "Removing container... "
docker container rm api-web-static-dev 2>/dev/null;
# créée l'image
echo "Building image... "
docker build -t api/apache-static . ;
# lance un container
docker run -d \
        -p 8080:80 \
        --name api-web-static-dev \
        --mount type=bind,src=$(pwd)/src-php,target=/var/www/html/ \
        api/apache-static;