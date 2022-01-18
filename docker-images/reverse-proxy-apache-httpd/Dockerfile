FROM php:8.0-apache
# Copie des fichiers de configuration
COPY 001-reverse-proxy.conf /etc/apache2/sites-available/001-reverse-proxy.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
# Activation des modules proxy d'Apache 
RUN a2enmod proxy proxy_http
# Activation de la configuration personnalisée
RUN a2ensite 000-* 001-*