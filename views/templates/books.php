<div class="title-search-container">
    <h1>Nos livres à l'échange</h1>
    <input class="search-input  " type="search" placeholder="Recherche un livre">
</div>

<div class="books-container">
    <?php
        foreach ($books as $book) {
            echo (sprintf('<aside class="books-content">
                        <img src="%s" alt="%s" class="book-thumbnail">
                        <h3 class="book-title">%s</h3>
                        <p class="book-author">%s</p>
                        <p class="book-seller">Vendu par : %s</p>
                    </aside>', $book->picture, $book->title, $book->title, $book->author, $book->seller));
        }
        ?>
</div>