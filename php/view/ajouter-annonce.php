
<section>
    <h3>Ajouter mon annonce immobilière</h3>
    <!-- POUR UPLOAD IL FAUDRA AJOUTER UN ATTRIBUT SUPPLEMENTAIRE... -->
    <!-- https://www.w3schools.com/php/php_file_upload.asp -->
    <div class="container">
    <form method="POST" action="#form-create" id="form-create">
        <label>
            <span>Nom de l'annonce</span>
            <input type="text" name="title" required placeholder="Nom de mon annonce" maxlength="160">
        </label>        
        <label>
            <span>Description de l'annonce</span>
            <textarea name="description" cols="80" rows="10" required placeholder="Décrivez les caractéristiques de votre annonce"></textarea>
        </label>
        <label>
            <span>Code Postal du bien</span>
            <input type="number" name="postal_code" required placeholder="Code postal" maxlength="160">
        </label>
        <label>
            <span>Ville</span>
            <input type="text" name="city" required placeholder="Ville" maxlength="160">
        </label>

        <label>
            <span>Type</span>
            
                <input type="radio" id="location" name="type" value="location" checked>
                <label for="location">Location</label>
                <input type="radio" id="vente" name="type" value="vente">
                <label for="vente">Vente</label>
        </label>
        <label>
            <span>Prix</span>
            <input type="number" name="price" required placeholder="Prix TTC" maxlength="160">
        </label>        

            <input type="hidden" name="reservation_message" value="">


        <button type="submit">PUBLIER VOTRE Annonce </button>
        <!-- PARTIE TECHNIQUE -->
        <input type="hidden" name="formIdentifiant" value="advert">
        <div>
            <?php require_once "php/controller/traitement-advert.php" ?>
        </div>
    </form>
</div>
</section>
