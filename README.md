# HTTP-Infra - 6c. Load balancing avec lancement de container à la volée
Dans cette partie, nous montrons comment profiter de Traefik pour lancer des nouveaux containers à la volée. En fait, Traefik a la capacité de recharger sa configuration à chaud, c'est-à-dire sans redémarrer. Il suffit donc de lancer de nouveaux containers. Traefik les détecte automatiquement et commence à leur envoyer des requêtes.
## Procédure de test
Pour que tout fonctionne correctement, il est impératif de se déplacer dans le dossier `docker-images/`.

1. Effacer les cookies pour le site `http://demo.api.ch/`. Lancer la commande :  
`docker-compose up --build`  
    - Trois containers sont lancés, un de chaque service.
2. Ouvrir un nouveau terminal et se placer dans le dossier `docker-images/`.
3. Avec `docker ps`, on contrôle qu'on a bien tois containers lancés.
4. Se connecter avec un navigateur à `demo.api.ch`. Au fil des rechargements de page, on constate que toujours le même serveur répond. C'est normal, car il n'y en a pas plus pour le moment.
6. Stopper le rechargement automatique. Si on clique plusieurs fois sur le bouton "Fetch web dynamic", on constate aussi que toujours le même serveur répond. Vérifier dans l'onglet Réseau des outils de développement du navigateur que les requêtes sont bien effectuées.
7. Revenir au deuxième terminal et lancer la commande :  
    `docker-compose up --scale web_dynamic=3`
8. Avec `docker ps` on voit que maintenant 5 containers sont en fonction.
8. Dans le navigateur, cliquer plusieurs fois sur le bouton "Fetch web dynamic". On constate qu'un serveur différent répond à chaque fois.
9. Les instances lancées à la volée ont bien été reconnues par Traefik.
10. Maintenant, on va arrêter les containers lancés à la volée :  
    `docker stop docker-images_web_dynamic_2 docker-images_web_dynamic_3`
11. Avec `docker ps`, on constate que les trois premiers containers tournent toujours. Le site web à l'adresse `demo.api.ch` est bien disponible.
12. Revenir dans le premier terminal et Presser `^C` pour arrêter tous les containers.
