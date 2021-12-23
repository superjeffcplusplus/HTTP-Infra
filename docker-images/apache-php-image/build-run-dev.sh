#!/bin/bash
docker container rm api-web-static-dev 2>/dev/null;
docker build -t api/apache-static-dev . ;
docker run -d \
        -p 80:80 \
        --name api-web-static-dev \
        --mount type=bind,src=$(pwd)/src-php,target=/var/www/html/ \
        api/apache-static-dev ;