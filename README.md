# ADIDASH
Site de gestion de projet pour ADIMAKER


## Comment installer
- Cloner le projet
- Installer PHP 7.3
- Installer Composer avec PHP à la bonne version
- Installe NodeJS 14
- Executer ``composer update`` pour installer les dépendances PHP
- Executer ``npm install`` pour installer les dépendances NodeJS
- Copier le contenu dans ``.env.example`` dans un nouveau fichier .env
- Executer ``php artisan key:generate`` pour créer la clée de chiffrement
- Configurer la base de donnée dans .env
- Executer ``php artisan migrate:install`` pour mettre en place le layout de base de donnée
- Executer ``php artisan migrate`` pour installer la dernière version des structures BDD

## Organisation
Trello: [Tableau Appli Web](https://trello.com/b/nj5wNvU2/appli-web)
Pour contribuer, il vaut mieux créer un fork et le cloner.
Pensez à récupérer souvent les changements du git parent ("upstream") avec
```bash
git remote update -p
git merge --ff-only @{u}

#Si et seulement la commande précedente rate
git rebase -p @{u}
```
