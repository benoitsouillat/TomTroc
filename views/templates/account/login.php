<section class="screen50 container">
    <div class="login-container">
        <?php
        if (!empty($_SESSION['register']['message'])) {
            echo sprintf("<div class='message success-message'>%s</div>", $_SESSION['register']['message']);
            $_SESSION['register']['message'] = [];
        }
        if (!empty($_SESSION['connection']['errors'])) {
            echo sprintf("<div class='message error-message'>%s</div>", $_SESSION['connection']['errors']);
            $_SESSION['connection']['errors'] = [];
        }
        ?>
        <h1>Connexion</h1>
        <form action="index.php?action=login" method="post">
            <label for="email">Adresse email</label>
            <input name="email" id="email" class="form-item" type="email">
            <label for="password">Mot de passe</label>
            <input name="password" id="password" class="form-item" type="password">
            <p class="text-darkgrey">Pas de compte ? <a class="text-darkgrey"
                    href="/index.php?action=register">Inscrivez-vous</a></p>
            <input type="submit" class="btn" value="Se connecter">
        </form>
    </div>
    <div class="image-container">
        <img src='/public/media/bibliotheque.png' alt='Etagère de livre'>
    </div>
</section>