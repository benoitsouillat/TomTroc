<section class="container account-container">
    <h1>Modifier l'image de profil</h1>
    <?php
    if (!empty($_SESSION['picture']['errors'])) {
        echo sprintf("<div class='message error-message'>%s</div>", $_SESSION['picture']['errors']);
    }
    $_SESSION['picture']['errors'] = [];
    ?>
    <div class="edit-picture-container">
        <form action="index.php?action=account" method="post" enctype="multipart/form-data">
            <label for="profile_thumbnail">Choisissez votre photo de profil</label>
            <input type="file" id='profile_thumbnail' name='profile_thumbnail' accept="image/*">
            <input type="submit" class="btn btn-reverse" value="Mettre à jour">
        </form>
    </div>

</section>