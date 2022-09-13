# BTS SIO - Faille XSS et sécurisaiton de formulaire

## installation

renommer _.env.example en .env 
renommer app/_.env.example en app/.env 

docker compose up -d

se connecter sur phpmyadmin et crée la base app_db puis importer le script SQL contenu dans /docs

se connecter au container app pour executer composer install