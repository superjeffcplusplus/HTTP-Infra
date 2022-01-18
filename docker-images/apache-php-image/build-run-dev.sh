#!/bin/bash
# arrête le container 
docker container kill api-web-static-dev;
# supprime le container
docker container rm api-web-static-dev 2>/dev/null;
docker build -t api/apache-static-dev . ;
docker run -d \
        # lie le port 8080 de l'hôte au port 80 du container
        -p 80:8080 \ 
        --name api-web-static-dev \
        # Volume
        --mount type=bind,src=$(pwd)/src-php,target=/var/www/html/ \
        api/apache-static-dev ;