<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 02/05/2018
 * Time: 11:33
 */
session_start();

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="css/style_accueil.css" />
        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />

        <title>Accueil</title>
    </head>

    <body>
        <?php include("include/menuhaut.php") ?>

        <div id="conteneur">
            <section id="profil">
                <img src="profil.png" width="100px" height="100px" alt="Photo de profil par défault" />
                <p>Prénom Nom</p>
                <p>Titre</p>
                <p>Email</p>
                <p>50 relations</p>
            </section>

            <section id="mur">
                <article>
                    <p>Ecrire votre statut</p>
                </article>
                <article>
                    <p>Ecrire votre statut</p>
                </article>
                <article>
                    <p>Ecrire votre statut</p>
                </article>
            </section>
        </div>
    </body>
</html>