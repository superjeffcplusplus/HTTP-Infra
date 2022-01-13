FROM php:8.1-apache

COPY apache2-foreground /usr/local/bin/
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY templates/ /etc/apache2/templates

RUN a2enmod proxy proxy_http