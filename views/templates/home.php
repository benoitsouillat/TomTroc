<?php

?>

<section id="presentation">
    <div>
        <h2>Rejoignez nos lecteurs passionnés</h2>
        <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en
            la magie du partage de connaissances et d'histoires à traver les livres.</p>
    </div>
    <div>
        <a href="" title="Découvrir" class="btn btn-small">Découvrir</a>
    </div>
</section>
<section id="last-book">
    <h2>Les derniers livres ajoutés</h2>
    <div class="last-book-container">
        <?php
        foreach ($books as $book) {
            echo (sprintf('<aside class="last-book-content">
                        <img src="%s" alt="%s" class="book-thumbnail">
                        <h3 class="book-title">%s</h3>
                        <p class="book-author">%s</p>
                        <p class="book-seller">Vendu par : %s</p>
                    </aside>', $book['picture'], $book['title'], $book['title'], $book['author'], $book['seller']));
        }
        ?>
    </div>
    <a href="/index.php?action=books" title="Tous les livres" class="btn">Voir tous les livres</a>
</section>
<section id="how-work">
    <h2>Comment ça marche ?</h2>
    <p class="description">Échanger des livres avec TomTroc c'est simple et amusant ! Suivez ces étapes pour commencer :
    </p>
    <div class="how-work-container">
        <div class="how-work-content">
            <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
        </div>
        <div class="how-work-content">
            <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
        </div>
        <div class="how-work-content">
            <p>Parcourez les livres disponibles chez d'autres membres.</p>
        </div>
        <div class="how-work-content">
            <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
        </div>
    </div>
    <a href="/books" class="btn btn-reverse" title="Tous les livres">Voir tous les livres</a>
</section>