<section class="container account-container">
    <h1>Mon compte</h1>
    <?php
    if (!empty($_SESSION['connection']['message'])) {
        echo $_SESSION['connection']['message'];
    }
    if (!empty($_SESSION['editbook']['message'])) {
        echo  $_SESSION['editbook']['message'];
    }
    $_SESSION['connection']['message'] = [];
    $_SESSION['editbook']['message'] = [];
    ?>
    <div class="data-container">
        <div class="image-container">
            <img class='thumbnail-user' src=<?= $_SESSION['user']['thumbnail'] ?> alt="profil-thumbnail">
            <a class="text-grey" href='/index.php?action=edit_thumbnail'>modifier</a>
        </div>
        <div class="info-container">
            <p class="pseudo"><?= $_SESSION['user']['pseudo'] ?></p>
            <p class="member-since text-grey">Membre depuis 1 an</p>
            <p class="library"><span>Bibliothèque</span><br>
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="14" viewBox="0 0 11 14" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.46556 0.160154L7.2112 0.00251429C6.65202 -0.0365878 6.16701 0.385024 6.12791 0.944207L5.32192 12.4705C5.28281 13.0296 5.70442 13.5147 6.26361 13.5538L8.51796 13.7114C9.07715 13.7505 9.56215 13.3289 9.60125 12.7697L10.4072 1.24345C10.4464 0.684262 10.0247 0.199256 9.46556 0.160154ZM6.84113 0.99408C6.85269 0.828798 6.99605 0.70418 7.16133 0.715737L9.41568 0.873377C9.58096 0.884935 9.70558 1.02829 9.69403 1.19357L8.88803 12.7198C8.87647 12.8851 8.73312 13.0097 8.56783 12.9982L6.31348 12.8405C6.1482 12.829 6.02358 12.6856 6.03514 12.5203L6.84113 0.99408Z"
                        fill="#292929" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M3.27482 0.0648067H1.01496C0.454414 0.0648067 0 0.519224 0 1.07977V12.6342C0 13.1947 0.454416 13.6491 1.01496 13.6491H3.27482C3.83537 13.6491 4.28979 13.1947 4.28979 12.6342V1.07977C4.28979 0.519221 3.83537 0.0648067 3.27482 0.0648067ZM0.714965 1.07977C0.714965 0.914086 0.849279 0.779771 1.01496 0.779771H3.27482C3.44051 0.779771 3.57482 0.914086 3.57482 1.07977V12.6342C3.57482 12.7999 3.44051 12.9342 3.27482 12.9342H1.01496C0.849279 12.9342 0.714965 12.7999 0.714965 12.6342V1.07977Z"
                        fill="#292929" />
                </svg><?= count($books) ?> <?= count($books) > 1 ? 'livres' : 'livre' ?>
            </p>
        </div>
    </div>

    <div class="informations-container">
        <h2>Vos informations personnelles</h2>

        <form method="post"
            action="index.php?action=account<?= isset($_GET['edit-password']) ? '&edit-password' : '' ?>">
            <?php
            if (!empty($_SESSION['user']['errors'])) {
                echo "<div class='message error-message w-auto'>";
                foreach ($_SESSION['user']['errors'] as $error) {
                    echo $error . '<br>';
                }
                echo "</div>";
                $_SESSION['user']['errors'] = [];
            }
            if (!empty($_SESSION['user']['message'])) {
                echo sprintf("<div class='message success-message w-auto'>%s</div>", $_SESSION['user']['message']);
                $_SESSION['user']['message'] = [];
            }
            if (!isset($_GET['edit-password'])) {
            ?>
            <label for="email">Adresse email</label>
            <input name="email" id="email" class="form-item" type="email" value=<?= $_SESSION['user']['email'] ?>>
            <label for="pseudo">Pseudo</label>
            <input name="pseudo" id="pseudo" class="form-item" type="text" value=<?= $_SESSION['user']['pseudo'] ?>>
            <div class="d-flex justify-between align-end">
                <input type="submit" class="btn btn-reverse" value="Enregistrer">
                <a href="./?action=account&edit-password" class="text-grey">Modifier le mot de passe</a>
            </div>
            <?php
            } else {
            ?>
            <label for="password">Mot de passe actuel</label>
            <input name="password" id="password" class="form-item" type="password" required>
            <label for="password">Nouveau mot de passe</label>
            <input name="newpassword" id="newpassword" class="form-item" type="password" required>
            <label for="password">Confirmer le mot de passe</label>
            <input name="confirm" id="confirm" class="form-item" type="password" required>
            <div class="d-flex justify-between align-end">
                <input type="submit" class="btn btn-reverse" value="Enregistrer">
                <a href="./?action=account" class="text-grey text-center">Retour</a>
            </div>


            <?php
            }
            ?>
        </form>
    </div>

    <div class="books-list-container">
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th class="w-50">Description</th>
                    <th>Disponibilité</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($books as $book) {
                    $available = $book->available == 1 ? "<span class='available'>Disponible</span>" : "<span class='unavailable'>Réservé</span>";
                    echo sprintf('
                    <tr class="book-row">
                        <td><div class="image-book"><img src="%s" alt="%s" width="50"></div></td>
                        <td><div class="title-book">%s</div></td>
                        <td><div class="author-book">%s</div></td>
                        <td><div class="description-book">%s</div></td>
                        <td><div class="available-book">%s</div></td>
                        <td><div class="actions-book">
                            <a href="/index.php?action=edit_book&book_id=%s" class="text-darkgrey link">Éditer</a>
                            <a href="/index.php?action=delete_book&book_id=%s" class="text-red link deleteBook">Supprimer</a>
                        </td>
                    </tr>', $book->picture, $book->title, $book->title, $book->author, $book->description, $available, $book->book_id, $book->book_id);
                }
                ?>
                <p class="d-flex justify-end"><a href='/index.php?action=edit_book' class="text-grey link">Ajouter un
                        livre</a></p>
            </tbody>
        </table>
    </div>
</section>