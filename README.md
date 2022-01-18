# HTTP-Infra - Serveur HTTP statique

Dans cette étape, nous devions mettre en place un site internet statique, avec une mise en page. Nous avons choisi de mettre en place un serveur Apache exécutant un script `PHP` pour générer une page `HTML` et fournir les feuilles de styles `CSS`, scripts `JavaScript` et images nécessaires au bon affichage de la page WEB.
## Utilisation de Docker
Pour commencer, se déplacer dans le dossier `docker-images/apache-php-image/`.

`cd docker-images/apache-php-image/`
### Dockerfile
Le fichier `Dockerfile` contient la recette de l'application WEB. Il se base sur l'image `php:8.0-apache` disponible sur le Dockerhub. Il copie simplement le contenu du dossier `src-php` dans le dossier de base d'Apache dans le container.
### Commandes `Docker`
- Créer une image Docker du projet : `docker build -t <nom de l'image> .`
    > Le point à la fin indique que le `Dockerfile` se trouve dans le dossier courrant.
- Lancer un container à partir de l'image :  `docker run -d -p 8080:80 <nom de l'image>`  
    > L'option `-p` permet de lier le port 80 du container au port 8080 de l'hôte.
- Arrêter proprement un container : `docker stop <id | nom du container>`
    > L'id du container d'obtient avec la commande `docker ps`.  
    > Pour lancer un container avec un nom, utiliser l'option `--name <nom>`.
- Relancer un container : `docker start <id | nom du container>`  
    > L'état précédant du container est conservé.
- Tuer un container : `docker kill <id | nom du container>`
- Supprimer un container : `docker rm <id | nom du container>`
- Supprimer une image : `docker image rm <nom de l'image>`

### Scripts
Deux scripts sont à disposition pour faciliter l'utilisation de Docker :
- `build-run-dev.sh` tue le container si nécessaire, puis le supprime, puis le recréée à partir du `Dockerfile`. Enfin le lance avec une option `--mount`. Cette dernière monte un volume de type `bind` dans le container, liant dynamiquement le contenu du dossier `src-php` avec le dossier dans lequel le serveur va chercher les fichiers lors d'une requête. Cette option rend directement visible depuis le container les modifications effectuées sur la machine hôte. Pratique pour le développement !
> Nom du container : api-web-static-dev
- `build-run-production.sh` fait la même chose que le premier script, mais sans l'option `--mount`. 
> Nom du container : api-web-static

Ces scripts évitent de retaper toute une série de commande lorsque que l'on veut simplement lancer un nouveau container avec une nouvelle version de l'image Docker. En effet, il est à chaque fois nécessaire d'arrêter les containers basés sur l'image, puis les supprimer, et enfin on peut relancer la commande `docker build`.

## Configuration d'Apache
Pour cette étape, la configuration par défaut du serveur Apache convenait. Dans le Dockerfile, on copie les fichiers du site web à l'emplacement qu'utilise Apache par défaut pour rechercher les dossiers de l'application WEB.

## Accès à l'application
L'application est accessible à l'adresse `http://localhost:8080` si on lance le container avec la commande recommandée ci-dessus.
