Installation de la base de donnée : 

Sur Docker : 
    - Lancer un docker compose up dans le repertoire racine
        - Mysql par défaut : localhost:3306 / username: root / password: 
        - PHPMyAdmin par défaut : localhost:8081
        - Site Tomtroc par défaut : localhost:8080
    - Installer la base de donnée en suivant la procédure PHPMyAdmin

Sur PHPMyAdmin :
    - Créer une base de donnée (nom par défaut : tomtroc)
    - Nom d'utilisateur par défaut : admin
    - Mot de passe utilisateur par défaut : password
    - Nom d'hôte par défaut : db
    (Vous pouvez modifier ces informations selon vos paramètre Mysql en modifiant le fichier /config/config.php)

    - Importer le fichier tomtroc.sql dans la base de donnée : (Route par défaut : /index.php?route=/database/import&db=tomtroc)


Le site est maintenant accessible, vous pouvez créer votre compte sur /index.php?action=login