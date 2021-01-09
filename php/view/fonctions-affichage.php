<?php
// DETECTER LES REPETITIONS DANS LE CODE HTML
// => BOUCLE AVEC PHP
// => CE QUI EST IDENTIQUE VA DANS LA BOUCLE
// => CE QUI CHANGE VA DANS LE TABLEAU
// => ON COMBINE LE TABLEAU ET LA BOUCLE PRODUIRE LE RESULTAT

/*
$image = [
    "./assets/img/article1.jpg",
    "./assets/img/article2.jpg",
    "./assets/img/article3.jpg",
    "./assets/img/article4.jpg",
];
*/


// AFFICHE UNE GALERIE D'IMAGES
function afficherGalerie ($chemin)
{
    // LA FONCTION glob CONSTRUIT LE TABLEAU POUR MOI
    // $image = glob("./assets/img/*.jpg");
    // https://www.php.net/manual/fr/function.glob.php
    $image = glob($chemin, GLOB_BRACE);

    foreach($image as $compteur => $element)
    {
        echo 
        <<<x
        <img src="$element" alt="$element">

        x;
    }

}

// DEFINITION 
function afficherAppart ()
{
    // article.php?id=3
    $id = $_GET["id"] ?? 0; // ON RECUPERE id PAR LE PARAMETRE GET
    /*
    // AVEC isset
    if (isset($_GET["id"])) // SI DANS LE TABLEAU $_GET IL Y A UNE CLE "id" AVEC UNE VALEUR
        $id = $_GET["id"]
    else
        $id = 0;
    */
    
    // SECURITE: ON CONVERTIT EN ENTIER
    // https://www.php.net/manual/fr/function.intval.php
    $id = intval($id);

    $tabLigne = lireLigne("advert", "id", $id);
    
    foreach($tabLigne as $ligneAsso)
    {
        extract($ligneAsso);


        $title = strtoupper($title);
        

        echo
        <<<codehtml
        
        <article>
            <h3><a href="annonce.php?id=$id">$title</a></h3>
            <h4>Prix : $price</h4>
            <p>$description</p>
            <p>type du bien: $type</p>
            <p> Localisation : $city $postal_code </p>
            
            <form method="POST">
            <div class="advert-update">
            <label>
            <span>Message de Réservation</span>
            <input type="text-area" name="reservation_message" cols="80" rows="10" required placeholder="contenu">
            </label>
            </div>
            <button type="submit" onClick="isReserved()">Réserver l'appartement</button>
            <input type="hidden" name="formIdentifiant" value="advert-update">
            <input type="hidden" name="id" value="$id">
            </div>
        </article>
        
        codehtml;
        

    }

}

?>
<script>
function isReserved() {
    var x = document.getElementById("isreserved");
    if (x.style.display === "none") {
      x.style.display = "block";
    } 
  }
  </script>
<?php
function afficherApparts() 
{
    // ON VA STOCKER LES INFOS DES ARTICLES DANS UNE TABLE SQL
    //  TOUJOURS LA DATABASE blog
    // CREER UNE TABLE SQL  article
    //  COMME COLONNES
    //      id                  INT             INDEX=primary   A_I (AUTO_INCREMENT)
    //      titre               VARCHAR(160)
    //      image               VARCHAR(160)
    //      contenu             TEXT
    //      datePublication     DATETIME
    //      ... 
    // ET AJOUTER QUELQUES LIGNES POUR LES ARTICLES... 

    // AJOUTER LE CODE PHP
    // RECUPERER LA LISTE DES ARTICLES
    // CREER LE CODE HTML POUR CHAQUE ARTICLE
    // REQUETE SQL:
    // SELECT * FROM `article`
    $tabLigne = lireTable("advert", "id DESC");

    // QUAND ON A UN TABLEAU ET ON VEUT LES ELEMENTS
    // => ON FAIT UNE BOUCLE
    foreach($tabLigne as $ligneAsso)
    {
        /*
        $titre = $ligneAsso["titre"];
        $image = $ligneAsso["image"];
        $contenu = $ligneAsso["contenu"];
        $datePublication = $ligneAsso["datePublication"];
        */
        // RACCOURCI SYMPA ;-p
        // https://www.php.net/manual/fr/function.extract.php
        // (ASTUCE: DONNER DES NOMS DE COLONNES SQL EN camelCase...)
        extract($ligneAsso);
        $title = strtoupper($title);

        // ON AFFICHE LE CODE HTML
        echo
        <<<codehtml
        
        <article>
            <h3><a href="annonce.php?id=$id">$title</a></h3>
            <h4>Prix : $price €</h4>
            <p>Type : $type</p>
            <p>Ville :$city</p>

        </article>

        codehtml;
    }
}

function afficher15Apparts() 
{
    // ON VA STOCKER LES INFOS DES ARTICLES DANS UNE TABLE SQL
    //  TOUJOURS LA DATABASE blog
    // CREER UNE TABLE SQL  article
    //  COMME COLONNES
    //      id                  INT             INDEX=primary   A_I (AUTO_INCREMENT)
    //      titre               VARCHAR(160)
    //      image               VARCHAR(160)
    //      contenu             TEXT
    //      datePublication     DATETIME
    //      ... 
    // ET AJOUTER QUELQUES LIGNES POUR LES ARTICLES... 

    // AJOUTER LE CODE PHP
    // RECUPERER LA LISTE DES ARTICLES
    // CREER LE CODE HTML POUR CHAQUE ARTICLE
    // REQUETE SQL:
    // SELECT * FROM `article`
    $tabLigne = lire15Table("advert", "id DESC");

    // QUAND ON A UN TABLEAU ET ON VEUT LES ELEMENTS
    // => ON FAIT UNE BOUCLE
    foreach($tabLigne as $ligneAsso)
    {
        /*
        $titre = $ligneAsso["titre"];
        $image = $ligneAsso["image"];
        $contenu = $ligneAsso["contenu"];
        $datePublication = $ligneAsso["datePublication"];
        */
        // RACCOURCI SYMPA ;-p
        // https://www.php.net/manual/fr/function.extract.php
        // (ASTUCE: DONNER DES NOMS DE COLONNES SQL EN camelCase...)
        extract($ligneAsso);
        $title = strtoupper($title);

        // ON AFFICHE LE CODE HTML
        echo
        <<<codehtml
        
        <article>
            <h3><a href="annonce.php?id=$id">$title</a></h3>
            <h4>Prix : $price €</h4>
            <p>Type : $type</p>
            <p>Ville :$city</p>

        </article>

        codehtml;
    }
}
