<?php

// CLASSE Form
class Form 
{
    // PROPRIETE DE CLASSE
    static $tabErreur = []; // tableau vide au départ
    // PARAMETRES POUR UPLOAD
    static $listeExtensionOk    = [ "jpg", "jpeg", "png", "gif", "webp", "svg" ];
    static $tailleMax           = 1024 * 1024 * 10;  // 10 Mo
    static $listeExtensionMini  = [ "jpg", "jpeg" ]; // , "png", "gif", "webp"

    // METHODE DE CLASSE
    static function estOK ()
    {
        // LE FORMULAIRE EST OK SI AUCUNE ERREUR N'A ETE STOCKEE
        $resultat = false;  // MODE PARANO
        if(count(Form::$tabErreur) == 0)
        {
            $resultat = true;
        }

        return $resultat;
    }

    static function filtrerEmail ($name)
    {
        $resultat = filtrer($name);
        if ($resultat == "")
        {
            Form::$tabErreur[] = "$name EST OBLIGATOIRE";
        }
        else if (false === filter_var($resultat, FILTER_VALIDATE_EMAIL))
        {
            // https://www.php.net/manual/fr/function.filter-var
            Form::$tabErreur[] = "$name EST UN EMAIL INCORRECT";
        }
        
        return $resultat;
    }

    static function filtrerEntier ($name)
    {
        $resultat = filtrer($name);
        if ($resultat == "")
        {
            Form::$tabErreur[] = "$name EST OBLIGATOIRE";
        }
        $resultat = intval($resultat);  // CONVERTIR EN ENTIER
        return $resultat;
    }

    static function filtrerTexte ($name)
    {
        $resultat = filtrer($name);
        if ($resultat == "")
        {
            Form::$tabErreur[] = "$name EST OBLIGATOIRE";
        }
        return $resultat;
    }

    static function filtrerUpload ($name)
    {
        $resultat = "";
        if ($_FILES[$name] ?? false)
        {
            $tabUpload = $_FILES[$name];
            extract($tabUpload);
            if ($error == 0)
            {
                $tabInfoFichier = pathinfo($name);
                extract($tabInfoFichier);
                $extension = strtolower($extension);    // CONVERTIT EN minuscules
                if (in_array($extension, Form::$listeExtensionOk)) 
                {
                    if ($size <= Form::$tailleMax)
                    {
                        $filename = strtolower(preg_replace("/[^a-zA-Z0-9-]/", "", $filename)); // A COMPLETER

                        $cheminFinal = "assets/upload/$filename.$extension"; 
                        // ON POURRAIT CHANGER LE NOM DU FICHIER (NE PAS GARDER LE NOM D'ORIGINE...)
                        // $cheminFinal = "assets/upload/logement_" . time() . ".$extension";

                        move_uploaded_file(
                            $tmp_name, 
                            $cheminFinal
                        );
                        // OK LE FICHIER EST DISPONIBLE
                        $resultat = $cheminFinal;

                        // SI LE FICHIER EST UNE IMAGE
                        if (in_array($extension, Form::$listeExtensionMini))
                        {
                            // ALORS JE CREE UNE MINIATURE AVEC LE MEME NOM MAIS DANS UN DOSSIER mini
                            $cheminMini = str_replace("/upload/", "/mini/", $cheminFinal);
                            // SI ON VEUT CHANGER LE NOM
                            // $cheminMini = "assets/mini/logement_" . time() . ".$extension";
                            Form::creerMini($cheminFinal, $cheminMini, 640);
                        }
                    }
                    else
                    {
                        // JE STOCKE LES ERREURS DANS LE TABLEAU
                        Form::$tabErreur[] = "ERREUR: FICHIER TROP VOLUMINEUX";
                    }
                }
                else
                {
                    Form::$tabErreur[] = "ERREUR: EXTENSION INTERDITE";
                }
            }
            else
            {
                Form::$tabErreur[] = "ERREUR: UPLOAD CORROMPU";
            }
                
 
        }
        else
        {
            Form::$tabErreur[] = "ERREUR: FICHIER MANQUANT";
        }

        return $resultat;
    }

    static function creerMini ($fichierSource, $fichierCible, $largeurCible)
    {
        $imageSource = imagecreatefromjpeg($fichierSource);
    
        if ($imageSource !== false)
        {
            $largeurSource = imagesx($imageSource);     // exemple: 1000
            $hauteurSource = imagesy($imageSource);     // exemple: 2000
        
            $hauteurCible = $hauteurSource * $largeurCible / $largeurSource ; 
        
            
            $imageCible = imagecreatetruecolor($largeurCible, $hauteurCible);  
        
            
            imagecopyresampled(
                $imageCible, $imageSource,
                0, 0,
                0, 0,
                $largeurCible, $hauteurCible,
                $largeurSource, $hauteurSource
            );
            
            imagejpeg($imageCible, $fichierCible);
        }
        else
        {

        }
    }
    
}

function filtrer ($name)
{

    $resultat = $_POST[$name] ?? ""; 


    $resultat = strip_tags($resultat);
    

    $resultat = trim($resultat);

    return $resultat;
}

function filtrerCamelCase ($name)
{
    $nom = filtrer($name);

    $nom = preg_replace("/[^a-zA-Z0-9]/", "", $nom);
    return $nom;
}

function envoyerEmail ($destinataire, $titre, $message)
{
    $headers =  'From: contact@monsite.fr' . "\r\n" .
    'Reply-To: no-reply@monsite.fr' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    @mail($destinataire, $titre, $message, $headers);

}

