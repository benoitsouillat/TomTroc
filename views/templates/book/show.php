<div class="breadcrumb container">
    <p class="text-grey"><a href='/index.php?action=books'>Nos livres</a> > <?= $book->title ?></p>
</div>
<div class="book-container screen50 container">
    <div class="image-container">
        <img src="<?= $book->picture ?>" alt="title">
    </div>
    <div class='description-container'>
        <?=
        sprintf("
        <h1>%s</h1>
        <p class='author'>par %s</p>
        ", $book->title, $book->author);
        ?>
        <hr>
        <p>DESCRIPTION</p>
        <?=
        sprintf("<p>%s</p>", $book->description);
        ?>
        <p>PROPRIÉTAIRE</p>
        <div class='owner-container'>
            <?=
            sprintf("<img class='thumbnail-user' src=%s alt=%s ><p>%s</p>", $book->thumbnail, $book->pseudo, $book->pseudo);
            ?>
        </div>
        <div class="btn-container">
            <a href="#" class="btn btn-full">Envoyer un message</a>
        </div>
    </div>
</div>