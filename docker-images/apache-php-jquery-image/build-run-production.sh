#!/bin/bash
docker container rm api-web-static 2>/dev/null;
docker build -t api/apache-static . ;
docker run -d \
        -p 80:80 \
        --name api-web-static \
        api/apache-static ;