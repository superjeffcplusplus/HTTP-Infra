# HTTP-Infra

## Étape 4: AJAX requests with JQuery
<br>
Pour cette étape nous avons implémenté des requêtes AJAX à l'aide de JQuery

<br>

### Configuration
La branche est structuée ainsi: <br>
- `apache-php-jquery-image`: dossier contenant l'image du serveur apache statique qui utilise jquery
    <br><br>

- 

    La structure des fichiers internes reste la même que dans les étapes précédentes
    <br><br>
- `docker-compose.yml` : fichier docker-compose permettant de gérer les différentes images docker
    <br>(la logique reste la même que à l'[étape 3](https://github.com/superjeffcplusplus/HTTP-Infra/blob/fb-apache-reverse-proxy/README.md))

### Choix
Nous avons choisi l
<br><br>

### Procédure
1. Créer les images et lancer les containers grâce au docker-compose :
   ```
   docker-compose up -d --build
   ```
   <br>
2. Depuis le navigateur aller à l'adresse : 
    http://localhost:80 TODO : 
    <br><br>
3. Sans avoir besoin de recharger la page, le contenu est changé automatiquement

    Exemple de résultat attendu:<br>