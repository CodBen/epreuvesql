<?php

$formIdentifiant = filtrer("formIdentifiant");

if ($formIdentifiant == "advert")
{


    $tabAsso = [
        "title"                         => Form::filtrerTexte("title"),
        "description"                   => Form::filtrerTexte("description"),
        "postal_code"                   => Form::filtrerTexte("postal_code"),
        "city"                          => Form::filtrerTexte("city"),
        "type"                          => Form::filtrerTexte("type"),
        "price"                         => Form::filtrerTexte("price"),
        "reservation_message"           => ("reservation_message"),
    ];

    extract($tabAsso);
 


    if ( Form::estOK() )
    {
        insererLigne("advert", $tabAsso); 

        
        $id = Model::lireNouvelId();

        // message de confirmation
        echo
        <<<x
        votre annonce est publié. 
        <a href="annonce.php?id=$id">cliquer ici pour aller sur la page de l'article</a>
        x;
    }
    else
    {
        
        echo "merci de ne pas hacker mon site";
    }
}

$formIdentifiant = filtrer("formIdentifiant");
if ($formIdentifiant == "advert-update")
{
    $message = form::filtrerTexte("reservation_message");

    $id = filtrer("id");        
    if ( Form::estOK() )
    {
        modifierLigne("advert", $id, $message);
        echo "Ce logement est réservé";
    }
    else
    {
        echo "merci de ne pas hacker mon site";
    }
}