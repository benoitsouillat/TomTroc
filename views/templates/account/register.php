<section class="screen50 container">
    <div class="register-container">
        <?php
        if (!empty($_SESSION['register']['errors'])) {
            echo "<div class='message error-message'>";
            foreach ($_SESSION['register']['errors'] as $error) {
                echo $error . '<br>';
            }
            echo "</div>";
        }
        $_SESSION['register']['errors'] = [];

        ?>
        <h1>Inscription</h1>
        <form action="index.php?action=register" method="post">
            <label for="pseudo">Pseudo</label>
            <input name="pseudo" id="pseudo" class="form-item" type="pseudo" required>
            <label for="email">Adresse email</label>
            <input name="email" id="email" class="form-item" type="email" required>
            <label for="password">Mot de passe</label>
            <input name="password" id="password" class="form-item" type="password" required>
            <label for="password">Confirmer le mot de passe</label>
            <input name="confirm" id="confirm" class="form-item" type="password" required>
            <p class="text-darkgrey">Déjà inscrit ? <a class="text-darkgrey"
                    href="/index.php?action=login">Connectez-vous</a>
            </p>
            <input type="submit" class="btn" value="S'inscrire">
        </form>
    </div>
    <div class="image-container">
        <img src='/public/media/bibliotheque.png' alt='Etagère de livre'>
    </div>
</section>