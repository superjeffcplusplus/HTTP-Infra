#!/bin/bash
docker run -d --name php_static api/php;
docker run -d --name http_dynamic api/http-dynamic;
docker run -d -p 8080:80 --name apache_rp api/apache_rp;