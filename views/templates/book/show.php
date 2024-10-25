<div class="breadcrumb"><a href='#'>Nos livres > Esther</a></div>
<div class="book-container screen50 container">
    <div class="image-container">
        <img src='/public/media/esther.png' alt="title">
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
            sprintf("<img class='thumbnail-user' src=%s alt=%s ><p>%s</p>", $book->thumbnail, $book->owner, $book->owner);
            ?>
        </div>
        <div class="btn-container">
            <a href="#" class="btn btn-full">Envoyer un message</a>
        </div>
    </div>
</div>