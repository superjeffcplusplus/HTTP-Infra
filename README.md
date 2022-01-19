# HTTP-Infra

## Etape 2: Serveur HTTP dynamique avec express.js
<br>
Pour cette étape nous avons créé un serveur qui tourne "node.js". <br>
Node.js exécute un programme qui simule un camion de glace en ligne. <br>
Celui-ci propose aléatoirement au client une glace avec certain nombre de boules (entre 1 et 3) de parfums aléatoires. <br> <br>
Les bibliothèques utilisées sont : <br>
- Chance : pour la gestion de l'aléatoire <br>
- Express : pour le serveur (gestion des requêtes, des clients...)

<br>

### Configuration
La branche est structuée ainsi: <br>
- `src` : contient tout les fichiers nécessaires à node.JS
    - `index.js` : le code source exécuté par node.js
    - `nodes_modules` : les modules (bibliothèques) utilisées
    - `package.json` : les information concernant le programme node.js (nom du programme, auteurs, version, descriptions, dépendances...) 
    <br><br>

- `build-run-prod.sh` : script bash permettant gérer le container docker en mode "production"<br>
- `build-run-dev.sh` : script bash permettant gérer le container docker en mode "développement"<br>

    Les deux fichiers de "build" gardent la même logique qu'à l'[étape 1](https://github.com/superjeffcplusplus/HTTP-Infra/tree/fb-apache-static/README.md).
    <br><br>

### Choix
Nous avons choisi le framework "Express" pour créer notre application web car il permet de faire très rapidement et facilement des sites minimalistes.
<br>
Il nous a permis grâce aux fonctions `listen()` et `get()` de créer une application web sans avoir à gérer nous-même des buffers, les clients etc.
<br><br>

### Procédure
1. Lancer le container docker :
   ```
   ./build.sh
   ```
   <br>
2. Depuis le navigateur aller à l'adresse : 
    http://localhost:1234
    <br><br>
3. À chaque chargement de page, une nouvelle glace est crée et est afficher dans l'interpréteur JSON du navigateur

    Exemple de résultat attendu:<br>
    ![result](/images/result.jpg)
