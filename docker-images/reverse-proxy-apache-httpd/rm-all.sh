#!/bin/bash
docker container rm web_static 2>/dev/null;
docker container rm web_dynamic 2>/dev/null;
docker container rm apache_rp 2>/dev/null;