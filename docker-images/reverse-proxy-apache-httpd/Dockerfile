FROM php:8.1-apache
COPY 001-reverse-proxy.conf /etc/apache2/sites-available/001-reverse-proxy.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod proxy proxy_http
RUN a2ensite 000-* 001-*