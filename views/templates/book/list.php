<div class="title-search-container">
    <h1>Nos livres à l'échange</h1>
    <form action="index.php" method="get">
        <input type="hidden" name="action" value="search_book">
        <label class="fa-solid fa-magnifying-glass" for="search-book"></label>
        <input name="search-book" id="search-book" class="search-input" type="search" placeholder="Rechercher un livre">
    </form>
</div>

<div class="books-container">
    <?php
    if (!empty($books))
    {
        foreach ($books as $book) {
            echo (sprintf('<a href="/index.php?action=book&book_id=%s"><aside class="books-content">
                            <img src="%s" alt="%s" class="book-thumbnail">
                            <h3 class="book-title">%s</h3>
                            <p class="book-author">%s</p>
                            <p class="book-seller">Vendu par : %s</p>
                        </aside></a>', $book->book_id, $book->picture, $book->title, $book->title, $book->author, $book->seller));
        }
    }
    else {
        echo "<p>";
        foreach ($errors as $error) {
            echo sprintf("<br> %s ", $error);
        }
        echo "</p>";
    }
    ?>
</div>