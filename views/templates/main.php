<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TomTroc</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./public/css/style.css">
        <script src="https://kit.fontawesome.com/1864bd3c57.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <header>
            <nav class="navigation container" role="navigation">
                <ul class="main-navigation" aria-label="main-navigation">
                    <li class="logo-container"><a href="/" title="TomTroc"><img src="./public/media/logo.png" alt="logo"></a></li>
                    <li class="link-container"><a href="/">Accueil</a></li>
                    <li class="link-container"><a href="/index.php?action=books">Nos livres à l'échange</a></li>
                </ul>
                <ul class="user-navigation" aria-label="user-navigation">
                    <li class="link-container"><a href="/index.php?action=messages">Messagerie</a></li>
                    <li class="link-container"><a href="/index.php?action=account">Mon Compte</a></li>
                    <li class="link-container">
                        <?= empty($_SESSION['user']) ? '<a href="/index.php?action=login">Connexion</a>' : '<a href="/index.php?action=logout">Déconnexion</a>'; ?>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <?= $content ?>
        </main>

        <footer>
            <nav class="container" role="secondary-navigation">
                <ul>
                    <li><a href="/confidentiality">Politique de confidentialité</a></li>
                    <li><a href="/legals">Mentions légales</a></li>
                    <li>
                        <p>Tom Troc &copy;</p>
                    </li>
                    <li><a href="/"><img src="/public/media/logo-tt.png" alt="logo"></a></li>
                </ul>
            </nav>
        </footer>
        <script src="/public/js/confirm.js"></script>
    </body>
</html>