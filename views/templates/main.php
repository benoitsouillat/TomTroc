<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomTroc</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav role="main-navigation">
            <div role="title">
                <a href="/home" title="TomTroc"><img src="" alt="logo">
                    <h1>Tom Troc</h1>
                </a>
            </div>
            <ul>
                <li><a href="/home">Accueil</a></li>
                <li><a href="/book/trade">Nos livres à l'échange</a></li>
            </ul>
            <ul>
                <li><a href="/user/messages">Messagerie</a></li>
                <li><a href="/user/account">Mon Compte</a></li>
                <li>
                    <?php
                    if (!isset($_SESSION['user']))
                        echo '<a href="/user/login">Connexion</a>';
                    else
                        echo '<a href="/user/logout">Déconnexion</a>';
                    ?>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <?= $content ?>
    </main>

    <footer>
        <nav role="secondary-navigation">
            <ul>
                <li><a href="/confidentiality">Politique de confidentialité</a></li>
                <li><a href="/legals">Mentions légales</a></li>
            </ul>
        </nav>
        <div>
            <p>Tom Troc &copy;</p>
            <a href="/home"><img src="" alt="logo"></a>
        </div>
    </footer>
</body>

</html>