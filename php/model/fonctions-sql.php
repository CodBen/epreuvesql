<?php

class Model
{


    static $dbh = null;
    static $tabRequete = [];

    static function stockerRequete ($sth)
    {

        ob_start();                 // COMMENCE A DETOURNER L'AFFICHAGE
        $sth->debugDumpParams();    // AFFICHAGE DETOURNE
        $texte = ob_get_clean();    // FIN DU DETOURNEMENT

        // ON VA MEMORISER LE TEXTE POUR L'AFFICHER PLUS TARD
        Model::$tabRequete[] = $texte;
    }

    // NOTE: NORMALEMENT CETTE METHODE DEVRAIT ETRE DANS LA PARTIE VIEW...
    static function afficherDebug ()
    {
        // DEBUG DES INFOS RECUES PAR LES FORMULAIRES
        $nbInfo = count($_REQUEST);
        echo "$nbInfo INFOS RECUES PAR LES FORMULAIRES\n";
        print_r($_REQUEST);
        echo "\n";


        $nbRequete = count(Model::$tabRequete);
        echo "IL Y A EU $nbRequete REQUETES SQL POUR CETTE PAGE\n";
        foreach(Model::$tabRequete as $indice => $requete)
        {
            echo 
            <<<x
            ------- requete SQL $indice -------
            $requete

            x;

        }        
    }

    static function compterLigne($table)
    {
        // https://sql.sh/fonctions/agregation/count
        // PRATIQUE SI ON VEUT JUSTE COMPTER LE NOMBRE DE LIGNE
        $requeteSQL = 
        <<<x
        SELECT count(*) FROM $table;
        x;

        $resultat = envoyerRequeteSql($requeteSQL, []);
        // RACCOURCI: POUR OBTENIR LE RESULTAT DIRECTEMENT
        // https://www.php.net/manual/fr/pdostatement.fetchcolumn.php
        $nbLigne = $resultat->fetchColumn();
        return $nbLigne;
    }

    // PERMET DE RETROUVER L'id QUE SQL VIENT DE CREER POUR LA NOUVELLE LIGNE
    static function lireNouvelId ()
    {
        // https://www.php.net/manual/fr/pdo.lastinsertid.php
        $nouvelId = Model::$dbh->lastInsertId();
        return $nouvelId;
    }
} 

// ETAPE 1: DEFINITION
function envoyerRequeteSql ($requeteSQL, $tabAsso)
{
    // CONNEXION AVEC LA DATABASE MySQL
    $user       = 'root';
    $password   = '';           // SUR XAMPP
    $hostSQL    = 'localhost';  // 127.0.0.1
    $portSQL    = '3306';
    $database   = 'wf3_php_intermediaire_benjamin';       // LE SEUL A CHANGER EN LOCAL A CHAQUE PROJET
    
    $mysql        = "mysql:host=$hostSQL;port=$portSQL;dbname=$database;charset=utf8";
    
    try {

        if (Model::$dbh == null) {
            // ON N'A PAS ENCORE OUVERT DE CONNEXION
            // ON VA CREER UNE CONNEXION
            Model::$dbh = new PDO($mysql, $user, $password);   // CONNEXION ENTRE PHP ET MySQL
            // MAINTENANT QU'ON A UNE CONNEXION Model::$dbh != null
        }

        $sth = Model::$dbh->prepare($requeteSQL);          // ON FOURNIT NOTRE REQUETE SQL PREPAREE (AVEC LES TOKENS)
        $sth->execute($tabAsso);                    // ON EXECUTE NOTRE REQUETE SQL (AVEC LE TABLEAU ASSO ET LES VALEURS)
    

        // DEBUG
        Model::stockerRequete($sth);


        return $sth;

    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }

}


function insererLigne ($table, $tabAsso)
{
    $listeColonne = "";
    $listeToken   = "";
    foreach($tabAsso as $cle => $valeur)
    {
        $listeColonne .= ",$cle";
        $listeToken   .= ",:$cle";
    }

    $listeColonne = trim($listeColonne, ",");
    $listeToken   = trim($listeToken, ",");

    $requeteSQL = 
    <<<x
    
    INSERT INTO $table 
    ($listeColonne) 
    VALUES 
    ($listeToken);
    
    x;
        
    $resultat = envoyerRequeteSql($requeteSQL, $tabAsso);
    return $resultat;
}

function lireLigne ($table, $colonne, $valeurFiltre)
{
    $requeteSQL =
    <<<x
    
    SELECT * FROM $table
    WHERE $colonne = '$valeurFiltre'

    x;

    $resultat = envoyerRequeteSql($requeteSQL, []);
    $tabLigne = $resultat->fetchAll(PDO::FETCH_ASSOC); 

    return $tabLigne;    

}

function lireTable ($table, $tri)
{
    $requeteSQL =
    <<<x
    SELECT * FROM $table
    ORDER BY $tri

    x;

    $resultat = envoyerRequeteSql($requeteSQL, []);
    // https://www.php.net/manual/fr/pdostatement.fetchall.php
    // EN JS    objet.methode()
    // EN PHP   $objet->methode()
    $tabLigne = $resultat->fetchAll(PDO::FETCH_ASSOC);  // ON VA OBTENIR UN TABLEAU DE TABLEAUX ASSOCIATIFS
    return $tabLigne;       // RESULTAT ON RENVOIE LE TABLEAU DE LIGNES SELECTIONNEES
}

function lire15Table ($table, $tri)
{
    $requeteSQL =
    <<<x
    SELECT * FROM $table
    ORDER BY $tri
    LIMIT 15;

    x;

    $resultat = envoyerRequeteSql($requeteSQL, []);

    $tabLigne = $resultat->fetchAll(PDO::FETCH_ASSOC);  
    return $tabLigne;      
}


function supprimerLigne($table, $id)
{

    $requeteSQL =
    <<<x
    DELETE FROM `$table`
    WHERE id = :id
    x;


    $resultat = envoyerRequeteSql($requeteSQL, [ "id" => $id ]);
    return $resultat;
}


function modifierLigne ($table, $id, $message)
{
    $id = intval($id);  


    $requeteSQL =
    <<<x
    
    UPDATE $table
    SET
       reservation_message = "$message"
    WHERE
        id = $id    
    x;

    envoyerRequeteSql($requeteSQL, []);
}


