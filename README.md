# HTTP-Infra

Ce travail est destiné à l'apprentissage de la mise en place d'une infrastructure web http. Il est constitué de 5 étapes principales, puis d'une sizième supplémentaires découpée en plusieurs sous-étapes.
Les consignes pour ce travail se trouvent sur GitHub à l'adresse https://github.com/HEIGVD-Course-API/API-2021-HTTP-Infra.

## Branches
Une branche `git` différencie chaque étape.


| Etape                  | Branche |
| ---------------------- | ------- |
| Serveur HTTP statique  | fb-apache-static |
| Serveur HTTP dynamique | fb-express-dynamic |
| Reverse proxy          | fb-apache-reverse-proxy |
| Requêtes Ajax          |fb-ajax-jquery|
| Reverse proxy avec configuration dynamique | fb-dynamic-configuration

Pour passer d'une étape de réalisation à l'autre, exécuter la commande `git checkou <nom branche>` depuis le dossier de base du projet.

Dans chaque branche, on trouvera un fichier readme.md qui explique comment faire fonctionner l'application et qui répond aux questions posées dans la consigne.

## Dépendances

- Docker doit être installé et lancé pour faire fonctionner chaque étape.
Pour l'installation, suivre le lien https://www.docker.com/get-started.
- En outre, à partir de l'étape 5, docker-compose est requis. Pour l'installation, suivre le lien https://docs.docker.com/compose/install/.