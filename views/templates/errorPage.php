<section class="container">
    <h1>ERREUR 404 </h1>
    <p>La ressource demandée n'existe pas</p>
    <?php
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo sprintf("<p> >> %s</p>", $error);
        }
    }
    ?>
</section>