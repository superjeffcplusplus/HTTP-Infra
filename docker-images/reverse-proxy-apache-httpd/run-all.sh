#!/bin/bash
docker run -d --name web_static --hostname web_static api/php;
docker run -d --name web_dynamic --hostname web_dynamic api/http-dynamic;
docker run -d -p 8080:80 --name apache_rp api/apache_rp;