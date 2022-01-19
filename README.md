# HTTP-Infra - 6a. Load balancing avec sticky session
Dans cette partie, nous implémentons la notion de sticky session. Cela veut dire que le reverse proxy doit reconnaître le client afin de le rediriger vers le serceur quel il s'est déjà connecté.

## Utilisation de Docker

Rien ne change par rapport à l'utilisation de Docker par rapport à l'étape précédente.
### docker-compose.yml
Avec Traefik, il faut simplement ajouter la ligne suivante à la liste de labels à la configuration du service qui nécessite de sauvegarder l'état entre les connexions :
```yml
...
labels:
    ...
    - traefik.http.services.web-static.loadbalancer.sticky.cookie.name=session
    ...
```
Nous avons ajouté cette ligne uniquement pour le service web_static.
## Application

L'application web est la même que l'étape précédente.
## Procédure de test
Pour que tout fonctionne correctement, il est impératif de se déplacer dans le dossier `docker-images/`.
1. Lancer la commande :  
`docker-compose up --scale web_static=5 --scale web_dynamic=5 --build`  
Ceci lance 5 instances de chaque serveur. Ne pas utiliser l'option `-d` pour cette étape.
2. Accéder à l'adresse `demo.api.ch` dans un navigateur. Attention, le fichier `hosts` de l'hôte doit être configuré correctement.
3. Un script recharge la page régulièrement. On constate que le nom d'hôte ne change pas.
4. Essayer de se connecter/déconnecter à l'aide des boutons prévus. Au besoin, désactiver le rechargement automatique avec le bouton prévu. Le comportement est cohérent. La session établie avec le serveur est correctement gérée.
5. Consulter les logs dans la console. On remarque que le reverse proxy distribue toujours au même serveur les requêtes.
6. Stoper le rechargement automatique.
7. Cliquer une dizaine de fois sur le bouton "Fetch web_dynamic". On voit grâce aux informations affichées qu'un serveur différent répond à chaque foi. Il n'y a pas de sauvegarde de session pour le serveur NodeJs.
8. Presser `^C` pour arrêter tous les containers.
