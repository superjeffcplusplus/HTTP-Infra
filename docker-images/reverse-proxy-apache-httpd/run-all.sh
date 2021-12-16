#!/bin/bash
docker run -d --name php_static api/php;
docker run -d --name apache2_rp api/apache2_rp;