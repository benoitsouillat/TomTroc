<div class="breadcrumb-container container">
    <div class="breadcrumb">
        <p class="text-grey"><a href='/index.php?action=books'>Nos livres</a> > <?= $book->title ?></p>
    </div>
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
            sprintf("<a href='/index.php?action=profile&userID=%s'><img class='thumbnail-user' src=%s alt=%s ><p>%s</p></a>", $book->owner, $book->thumbnail, $book->pseudo, $book->pseudo);
            ?>
        </div>
        <div class="btn-container">
        <?=
            !empty($_SESSION['user']) 
            ?   (userSessionValidator::checkUserIdNotSessionUser($book->owner)  
                ? sprintf('<a href="/index.php?action=messages&user_toID=%s" class="btn btn-full">Envoyer un message</a>', $book->owner)
                : '')
            :
                "<p class='text-end'><a href='/index.php?action=login' class='text-grey'>Se connecter pour envoyer un message</a></p>"
        ?>
        </div>
    </div>
</div>