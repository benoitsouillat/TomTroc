<div class="title-search-container">
    <h1>Nos livres à l'échange</h1>
    <form action="">
        <label class="fa-solid fa-magnifying-glass" for="search-book"></label>
        <input name="search-book" id="search-book" class="search-input" type="search" placeholder="Rechercher un livre">
    </form>
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