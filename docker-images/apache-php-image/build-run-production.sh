#!/bin/bash
# arrête le container 
echo "Killing container... "
docker container kill api-web-static 2>/dev/null;
# supprime le container
echo "Removing container... "
docker container rm api-web-static 2>/dev/null;
# créée l'image
echo "Building image... "
docker build -t api/apache-static . ;
# lance un container
docker run -d \
        -p 8080:80 \
        --name api-web-static \
        api/apache-static;