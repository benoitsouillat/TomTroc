<div class="container">
    <div class="breadcrumb"><a href='/index.php?action=account'>
            <- Retour</a>
    </div>
    <?= sprintf("<h1>Modifier l'image de %s</h1>", $book->title); ?>

</div>
<div class="book-container editbook-container screen50 container">
    <div class="description-container">
        <form method="post" action="/index.php?action=edit_book_picture<?= sprintf('&book_id=%s', $book->book_id) ?>"
            enctype='multipart/form-data'>
            <fieldset class="book_picture_fieldset">
                <label for='book_picture'>Choisissez une image</label>
                <input type="file" name="book_picture" id="book_picture"
                    accept="image/png, image/jpeg, image/jpg, image/webp, image/gif">
            </fieldset>
            <button type="submit" class="btn btn-reverse">Enregistrer</button>
        </form>
    </div>
    <div class="image-container">
        <p class="text-grey">Image actuelle :</p>
        <img src="<?= sprintf('%s', $book->picture) ?>" alt="<?= $book->title ?>">
    </div>
</div>