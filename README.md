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