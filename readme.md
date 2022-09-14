# BTS SIO - Faille XSS et sécurisation de formulaire

## installation

### Création des fichiers environnement

`cp _.env.example .env && cp app/_.env.example app/.env && cp hacker-site/_.env.example hacker-site/.env`

### Démarrage des services

`docker compose up -d`

### Installation des librairies composer

`docker exec -it secure-xss-app composer install && docker exec -it secure-xss-hacker-site composer install`
