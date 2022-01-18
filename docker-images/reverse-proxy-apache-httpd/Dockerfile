FROM php:8.1-apache
# Script de lancement d'Apache
COPY apache2-foreground /usr/local/bin/
# Configuration Apache par défaut
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY templates/ /etc/apache2/templates
# Activation des modules proxy
RUN a2enmod proxy proxy_http