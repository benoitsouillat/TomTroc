<div class="container">
    <div class="breadcrumb"><a href='#'>
            <- Retour</a>
    </div>
    <h1>Ajouter un livre</h1>
</div>
<div class="book-container screen50 container">
    <div class="image-container">
        <p class="text-grey">Photo</p>
        <img src='/public/media/esther.png' alt="title">
        <a href='#'>Modifier la photo</a>
    </div>
    <div class="description-container">
        <form action="">
            <fieldset class="book-formgroup">
                <label for='title'>Titre</label>
                <input type="text" name="title" id="title">
            </fieldset>
            <fieldset class="book-formgroup">
                <label for='author'>Auteur</label>
                <input type="text" name="author" id="author">
            </fieldset>
            <fieldset class="book-formgroup">
                <label for='comment'>Commentaire</label>
                <textarea name="comment" id="comment" rows="20"></textarea>
            </fieldset>
            <fieldset class="book-formgroup">
                <label for="available">Disponibilité</label>
                <select name="available" id="available">
                    <option>Disponible</option>
                    <option>Réservé</option>
                </select>
            </fieldset>
            <button type="submit" class="btn">Enregistrer</button>
        </form>
    </div>
</div>