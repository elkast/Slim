// documentation db

Comment exécuter le script :
Créer le fichier :

Copiez le code ci-dessus

Dans C:\laragon\www\, créez un fichier create_database.php

Collez le code dans ce fichier

Exécuter via le navigateur :

Lancez Laragon et démarrez les services

Ouvrez votre navigateur à l'adresse :

text
http://localhost/create_database.php
Vous devriez voir le message :
"Base de données et tables créées avec succès ! 🎉"

Vérifier dans phpMyAdmin :

Allez sur http://localhost/phpmyadmin

Vous devriez voir la base plateforme_reservation avec toutes vos tables

Important :
Sécurité :

Ce script ne doit être exécuté qu'une seule fois

Renommez ou supprimez le fichier après exécution

En production, utilisez des migrations (Laravel) plutôt que ce script

Configuration :

Les identifiants par défaut de Laragon sont utilisés (root/sans mot de passe)

Si vous avez modifié le mot de passe MySQL, mettez-le dans $password

Gestion des erreurs :

Le script affichera les erreurs SQL s'il y en a

Vérifiez que tous les services Laragon sont démarrés (icônes vertes)

Ce script crée l'ensemble de votre structure de base de données en une seule exécution. Vous pouvez maintenant commencer à développer votre application ! 🚀

