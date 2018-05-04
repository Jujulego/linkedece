<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 03/05/2018
 * Time: 14:57
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="css/style_accueil.css" />
        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />
        <link rel="stylesheet" href="css/style_photos.css" />
        <link rel="stylesheet" href="css/style_general.css" />

        <title>Mes photos</title>
    </head>

    <body>
        <?php include("include/menuhaut.php") ?>

        <div class="ajoutalbum"><button type="button" class="btn btn-default">Ajouter un album</button></div>
        <div id="groupealbums">
            <div class="album">
               <div class="lienalbum"> <a href=""> nom de l'album</a></div>
            </div>
            <div class="album">
                <div class="lienalbum"> <a href=""> nom de l'album</a></div>
            </div>

            <div class="album">
                <div class="lienalbum"><a href=""> nom de l'album</a></div>
            </div>
        </div>
    </body>
</html>
