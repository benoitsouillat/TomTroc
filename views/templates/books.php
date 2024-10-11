<?php

foreach ($books as $book) {
    echo sprintf(
        "<div>
        <img src='%s' alt='%s' >
        <p>%s</p>
        <p>%s</p>
        <p>Vendu par : %s</p>
        </div>",
        $book->picture,
        $book->title,
        $book->title,
        $book->author,
        $book->owner
    );
}
