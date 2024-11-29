<div class="container">
    <div class="breadcrumb"><a href='#'>
            <- Retour</a>
    </div>
    <?php if (empty($book)) {
        echo "<h1>Ajouter un livre</h1>";
    } else {
        echo "<h1>Modifier les informations</h1>";
    }
    ?>

</div>
<div class="book-container editbook-container screen50 container">
    <div class="image-container">
        <p class="text-grey">Photo</p>
        <img src='/public/media/esther.png' alt="title">
        <div class="linkend">
            <a
                href='/index.php/action=edit_book_picture<?= isset($book) ? sprintf('&book_id=%s', $book->book_id) : '' ?>'>Modifier
                la photo</a>
        </div>
    </div>
    <div class="description-container">
        <form method="post"
            action="/index.php?action=edit_book<?= isset($book) ? sprintf('&book_id=%s', $book->book_id) : '' ?>"
            enctype='multipart/form-data'>
            <?= isset($book) ? sprintf("<input type='hidden' value=%s name='bookId' >", $book->book_id) : "" ?>
            <fieldset class="book-formgroup">
                <label for='title'>Titre</label>
                <input type="text" name="title" id="title" value="<?= isset($book) ? $book->title : '' ?>">
            </fieldset>
            <fieldset class="book-formgroup">
                <label for='author'>Auteur</label>
                <input type="text" name="author" id="author" value="<?= isset($book) ? $book->author : '' ?>">
            </fieldset>
            <fieldset class="book-formgroup">
                <label for='comment'>Commentaire</label>
                <textarea name="comment" id="comment" rows="20"><?= isset($book) ? $book->description : '' ?></textarea>
            </fieldset>
            <fieldset class="book-formgroup">
                <label for="available">Disponibilité</label>
                <select name="available" id="available">
                    <option value="1" <?= isset($book) && $book->available == 1 ? 'selected' : '' ?>>Disponible</option>
                    <option value="0" <?= isset($book) && $book->available == 0 ? 'selected' : '' ?>>Réservé</option>
                </select>
            </fieldset>
            <button type="submit" class="btn"><?= isset($book) ? 'Valider' : 'Enregistrer' ?></button>
        </form>
    </div>
</div>