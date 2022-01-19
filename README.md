# HTTP-Infra

## Étape 4: AJAX requests with JQuery
<br>
Pour cette étape nous avons implémenté des requêtes AJAX à l'aide de JQuery

<br>

### Configuration
La branche est structuée ainsi: <br>
(seuls les principaux éléments y sont listés)
- `apache-php-jquery-image`: dossier contenant l'image du serveur apache statique qui utilise jquery
    - `src-php` : dossier avec les sources pour construire l'image
        - `index.php` : code source du site web dynamique php
        - `assets`: contient les différentes sources utilisées
            - `css` : les fichiers de styles utilisé pour le site
            - `images` : les images utilisées pour le site
            - `js` : les fichiers javascripts
                - `jquery.js` : la bibliothèque pour faire fonctionner jquery
                - `icecream.js` : le script faisant les requêtes AJAX
    - `Dockerfile` : fichier dockerfile pour la construction de l'image 
    <br><br>

- `nodejs-image` : n'a pas changé depuis l'étape précédente 
- `reverse-proxy-apache-httpd` :  n'a pas changé depuis l'étape précédente 

- `docker-compose.yml` : fichier docker-compose permettant de gérer les différentes images docker
    <br>(la logique reste la même que à l'[étape 3](https://github.com/superjeffcplusplus/HTTP-Infra/blob/fb-apache-reverse-proxy/README.md))

### Choix
Nous avons utilisé JQuery pour faire les requêtes AJAX pour plus de simplicité. Mais il aurais été possible de faire les requêtes directement en javascript avec la méthode `document.fetch()` qui utilise le concept des promesses. Cependant comme nous ne l'avons pas vu en cours, nous avons trouvé plus judicieux d'utilisé JQuery bien que ce framework offre bien plus de fonctionnalités que celles que nous utilisons réellement.
<br><br>

### Procédure
1. Créer les images et lancer les containers grâce au docker-compose :
   ```
   docker-compose up -d --build
   ```
   <br>
2. Depuis le navigateur aller à l'adresse : <br>
    http://demo.api.ch:8080/
    <br>
    > Le fichier host doit être modifié comme précisé à l'[étape précédente](https://github.com/superjeffcplusplus/HTTP-Infra/blob/fb-apache-reverse-proxy/README.md)
    
    <br>
3. Sans avoir besoin de recharger la page, le contenu est changé automatiquement

    Exemple de résultat attendu:<br>
    ![result](/images/result.gif)

4. Pour arrêter les containers :
    ```
    docker-compose stop
    ```