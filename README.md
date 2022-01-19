# HTTP-Infra - 5. Configuration dynamique du reverse proxy
Dans cette partie, nous avons amélioré la configuration du reverse proxy pour qu'on ait seulement à changer le docker-compose.yml si on veut modifier les noms d'hôtes.

## Utilisation de Docker

Pour que tout fonctionne correctement, il est impératif de se déplacer dans le dossier `docker-images/reverse-proxy-apache-httpd/`.

Pour cette partie, nous avons fait le choix s'utiliser `docker-compose`. C'est l'outil idéal pour lancer plusieurs containers à la fois. Il n'y a plus besoin de gérer les suppressions de containers et d'images si les configurations changent et qu'on veut recréer une image.
### Dockerfile
Nous avons modifié le Dockerfile concernant le reverse proxy. Désormais, le fichier de configuration d'Apache est généré lors du lancement d'Apache dans le container. La commande `COPY` relative à cela est supprimée. En revanche, il faut maintenant copier dans l'image le template et le script personnalisé de lancement d'Apache (voir ci-dessous). Ce dernier vient écraser le fichier fourni dans l'image officielle. Il est important qu'il porte exactement le même nom.
### docker-compose.yml
Le fichier `docker-compose.yml` change, car l'on veut maintenant définir des variables d'environnement pour le container reverse_proxy. On ajoute simplement la sous-clef `environment` dans la section du service `reverse_proxy` : 



```yml
...
reverse_proxy:
    build: .
    container_name: reverse_proxy
    ports:
      - "8080:80"
    environment:
      - WEB_STATIC_HOSTNAME=web_static
      - WEB_DYNAMIC_HOSTNAME=web_dynamic
...
```
> On passe les clefs des services en variables d'environnement, pour pouvoir les récupérer à l'intérieur du container. Cela sera utile pour générer le fichier de configuration d'Apache.
ent des containers

## Configuration Apache

- Dans le docker file, on ne s'occupe plus d'activer les configurations avec la commande `a2ensite`. En effet, nous voulons générer les configurations lors du lancement du container, et non intégrer une configuration directement dans notre image personnalisée.
- Pour arriver à nos fins, nous avons modifié le fichier  `apache2-foreground` présent dans le répertoire `/usr/local/bin/` de l'image. Nous avons simplement ajouté à la ligne 7 :
```bash
php /etc/apache2/templates/config-template.php > /etc/apache2/sites-available/001-reverse-proxy.conf;

a2ensite 000-* 001-*;
```
La première ligne permet de générer la configuration à partir d'un template en php. La seconde active la configuration. Dans le template php, nous récupérons simplement les variables d'environnement définies dans le docker-compose.yml. De cette manière, si on change les noms de domaines, un seul fichier sera à midifier.
## Procédure
Par rapport à l'étape précédente, rien ne change.
