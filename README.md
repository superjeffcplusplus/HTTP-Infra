# HTTP-Infra - 3. Reverse proxy avec Apache (configuration statique)

Dans cette partie, nous avons mis en place une infrastructure qui permet de masquer les serveurs qui distribuent le contenus WEB statique derrière un reverse-proxy. Cela permet d'accéder aux deux serveurs avec le même nom d'hôte.

## Utilisation de Docker

Pour que tout fonctionne correctement, il est impératif de se déplacer dans le dossier `docker-images/reverse-proxy-apache-httpd/`.

Pour cette partie, nous avons fait le choix s'utiliser `docker-compose`. C'est l'outil idéal pour lancer plusieurs containers à la fois. Il n'y a plus besoin de gérer les suppressions de containers et d'images si les configurations changent et qu'on veut recréer une image. Les scripts ssh sont caducs ! (Voir parties 1 et 2)  

### Dockerfile
Nous ne revenons pas sur les Dockerfiles provenant des précédentes étapes.  
Pour le serveur reverse proxy, nous utilisons la même image de base que pour l'étape WEB statique. Deux commandes `COPY` permettent de copier à l'intérieur de l'image docker les fichiers de configuration Apache. Enfin, on demande à Docker d'exécuter deux commande à l'intérieur de l'image. La première active les modules reverse proxy d'Apache, la seconde active les configurations copiées.
### docker-compose.yml
Le fichier `docker-compose.yml` est le nom par défaut du fichier de configuration de docker-compose. Il contient la description des services qu'on veut lancer. La le nom de la clef du service est important, car docker créée un réseau indépendant pour les containers lancés par un même fichier de configuration. A l'intérieur de ce réseau, les containers sont accessibles en utilisant le nom de service comme nom d'hôte. Cela facilite la configuration du reverse proxy, car il n'y a pas besoin de coder en dur des adresses IP ni de lancer dans un ordre précis les containers.  
Description des champs renseignés : 

```yml
services:
  reverse_proxy: # clef utlisée comme nom d'hôte
    build: . # chemin relatif du Dockerfile pour construire une image
    container_name: reverse_proxy # nom du container
    ports: # port mapping
      - "8080:80"
    ...
    depends_on: # indique que le container doit être lancé après le container renseigné ici.
    ...

```
### Commandes
- Créer les containers en créant les images auparavant :  
    `docker-compose up -d --build`
    - Option `-d` pour lancer en arrière plan et `--build` pour créer les images.  
    - L'option `--build` est nécessaire car le fichier de configuration contient des réfrences à des Dockerfile.
    - Si la commande a déjà été lancée une fois, il est possible d'omettre l'option `--build`. Cependant, les éventuelles modifications de configuration ne seront pas prises en compte.
- Arrêter les containers : `docker-compose stop`
- Redémarrer les containers : `docker-compose start`  
    - Conserve l'état précédent des containers

## Configuration Apache

- La balise `<VirtualHost *:80>` indique que l'on écoute toutes les requêtes qui arrivent sur le port TCP 80.
- La balise `ServerName` permet de préciser le nom de domaine.
    - On précise d'abord le chemin à laquelle la règle répond, puis l'adresse complète du serveur vers qui envoyer la requête.
- La balise `ProxyPass` enregistre une règle de redirection pour les requêtes provenant de l'extérieur.
    - On précise d'abord le chemin de réécriture, et ensuite l'adresse complète d'où provient la requête.
- La balise `ProxyPassReverse` enregistre une règle de réécriture pour les url provenant de l'intérieur, donc des serveurs web_static et web_dynamic dans notre cas.
> Ces règles doivent apparaître dans l'ordre de la plus générale à la plus précise, car la première bonne correspondance est choisie par Apache pour faire ses redirections. Dans notre cas, si on enregistrait en premier :
```conf
ProxyPass "/" "http://web_static:80/"
ProxyPassReverse "/" "http://web_static:80/"
```
, alors la seconde règle ne serait jamais atteinte, car "/" est le chemin le plus général possible.

## Accès à l'application
Dans la configuration, on demande à Apache de répondre aux requêtes adressées au nom de domaine `demo.api.ch`. C'est lui qu'il faut taper dans la bare d'adresse du navigateur. Pour que cela fonctionne, il faut ajouter une entrée au fichier `hosts` de la machine avec laquelle on veut accéder à l'application. Sa localisation dépend des systèmes d'exploitation, mais en général il se trouve dans `/etc/hosts`. Ajouter la ligne :
`127.0.0.1 demo.api.ch`.
On peut ensuite accéder à l'application grâce à l'url http://demo.api.ch.
- http://demo.api.ch/api/students/, sans oublier le dernier "/" : Le serveur web_dynamic devrait répondre.
- http://demo.api.ch : Le serveur web_static devrait répondre.