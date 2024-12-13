<?php

?>

<section id="presentation" class="section-marge">
    <div class="container hero-container">
        <div>
            <h1>Rejoignez nos lecteurs passionnés</h1>
            <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons
                en
                la magie du partage de connaissances et d'histoires à traver les livres.</p>
            <p>
                <a href="" title="Découvrir" class="btn btn-small">Découvrir</a>
            </p>
        </div>
        <div class="image-container">
            <img src='./public/media/hamza-nouasria.png' alt='Lecteur au milieu des livres' />
        </div>

    </div>
</section>
<section id="last-books" class="section-marge">
    <h2>Les derniers livres ajoutés</h2>
    <div class="books-container">
        <?php
        foreach ($books as $book) {
            echo (sprintf('<a href="/index.php?action=book&book_id=%s"><aside class="books-content">
                        <img src="%s" alt="%s" class="book-thumbnail">
                        <h3 class="book-title">%s</h3>
                        <p class="book-author">%s</p>
                        <p class="book-seller">Vendu par : %s</p>
                    </aside></a>', $book->book_id, $book->picture, $book->title, $book->title, $book->author, $book->seller));
        }
        ?>
    </div>
    <p class="text-center btn-container"><a href="/index.php?action=books" title="Tous les livres" class="btn">Voir tous
            les livres</a></p>
</section>
<section id="how-work" class="section-marge">
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
    <p class="text-center btn-container"><a href="/index.php?action=books" class="btn btn-reverse"
            title="Tous les livres">Voir tous les livres</a></p>
</section>
<section id='our-worth'>
    <div class="banner-container"></div>
    <div class="worth-content">
        <h2>Nos valeurs</h2>
        <p>Chez TomTroc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées
            dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la
            puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
        <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. </p>
        <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter,
            de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les
            étagères.</p>
        <p class="signature">L'équipe Tom Troc <svg width="122" height="104" viewBox="0 0 122 104" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1 96.2224V96.2224C2.29696 95.8216 6.2879 96.4842 7.64535 96.4785C34.2391 96.3656 77.2911 74.6923 96.4064 56.0062C109.127 40.7664 119.928 7.80529 85.8057 2.24352C65.0283 -1.1431 50.1873 26.7966 62.0601 33.1465C66.0177 35.2631 78.258 25.6112 65.0283 12.4034C51.7986 -0.804455 39.7279 0.126873 35.3463 2.24352C15.417 7.74679 2.27208 42.7137 71.8127 87.7558C96.4064 103.685 121 102.996 121 102.996"
                    stroke="#00AC66" stroke-width="2" stroke-linecap="round" />
            </svg></p>

    </div>
</section>