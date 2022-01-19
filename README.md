# HTTP-Infra - 6a. Load balancing sans sticky session
Dans cette partie, nous avons mis en place un reverse proxy Traefik pour permettre facilement la montée en charge.

## Utilisation de Docker

Pour cette partie, l'utilisation de `docker-compose` est incontournable.

### Commandes
- L'option --scale nomService=nbInstances permet de lancer des containers à la volée.
    - Exemple : `docker-compose up --scale web_static=5 --scale web_dynamic=5 --build`
    
### docker-compose.yml
Le fichier `docker-compose.yml` change pour mettre en place Traefik. Toute la configuration du reverse proxy s'y trouve. La clef `label` permet de définir les variables dont il a besoin pour rediriger les requêtes vers le bon container.
- Nom d'hôte pour la route :
    - traefik.http.routers.web_static.rule=Host("nom d'hôte")
- Chemin pour la route
    - traefik.http.routers.web-static.rule=PathPrefix("/le/chemin/")

## Application

L'application web est différente des étapes précédentes. Un script `php` a été écrit pour montrer le comportement des sessions en cas de mise en oeuvre de multiples instances d'une même application. Pour compléter la démonstration, quelques scripts en JavaScript ont été utiles.
## Procédure de test
Pour que tout fonctionne correctement, il est impératif de se déplacer dans le dossier `docker-images/`.
1. Lancer la commande :  
`docker-compose up --scale web_static=5 --scale web_dynamic=5 --build`
Ceci lance 5 instances de chaque serveur. Ne pas utiliser l'option `-d` pour cette étape.
2. Accéder à l'adresse `demo.api.ch` dans un navigateur. Attention, le fichier `hosts` de l'hôte doit être configuré correctement.
3. Un script recharge la page régulièrement. On constate que le nom d'hôte du serveur change à chaque rechargement. 
4. Essayer de se connecter/déconnecter à l'aide des boutons prévus. Le comportement est incohérent. On voit ainsi que le reverse proxy ne tient pas compte des sessions établies entre le navigateur et le serveur.
5. Consulter les logs dans la console. On remarque que le reverse proxy distribue toujours dans le même ordre les requêtes entre les instances de web_static. C'est en raison de l'alorithme round-rubin, utilisé pour répartir la charge.
6. Stoper le rechargement automatique.
7. Cliquer une dizaine de fois sur le bouton "Fetch web_dynamic". On voit grâce aux informations affichées qu'un serveur différent répond à chaque foi. L'ordre dans lequel le reverse proxy transmets les requêtes se lit aussi dans la console.
8. Presser `^C` pour arrêter tous les containers.
