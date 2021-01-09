<?php 
require_once "php/model/fonctions-sql.php";
require_once "php/view/fonctions-affichage.php";
require_once "php/controller/fonctions.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Le Bon Appart">
    <link rel="icon" type="house-logo.svg" href="logo.svg">

    <title>Le bon Appart</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- COMMENTAIRE HTML -->
</head>

<body>
    <header>
        <img class="header__img" src="./assets/img/house.png" alt="logo">
        <nav>
        <?php
// tableau associatif
$a = [
    // "cle"        => "valeur"
    "accueil.php"     => 'Accueil',
    "annonces.php"    => 'Consulter toutes les Annonces',
    "mon-annonce.php" => 'Ajouter une Annonce',
];
foreach($a as $cle => $valeur)
{
    // JE TESTE SI $valeur EST EGAL A $titre
    if ($valeur == $titre) 
    {
        echo 
        <<<html
            <a class="active" href="$cle">$valeur</a>

        html;
    
    }
    else
    {
        echo 
        <<<html
            <a class="" href="$cle">$valeur</a>
    
        html;

    }
}
?>
<!--
            <a href="index.php">Accueil</a>
            <a href="galerie.php">Galerie</a>
            <a href="contact.php">Contactez-Nous</a>
-->
        </nav>
    </header>
    <main>