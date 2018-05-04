<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 03/05/2018
 * Time: 15:40
 */?>

<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style_accueil.css" />
    <link rel="stylesheet" href="css/style_general.css" />
    <link rel="stylesheet" href="css/style_menuhaut.css" />
    <link rel="stylesheet" href="css/style_messagerie.css" />

    <title>Messagerie</title>
</head>
<body>
    <?php include("include/menuhaut.php") ?>

        <div id ="menugauche">
            <div class="recherche">
                <form>
                <table>
                   <td>Nouveau message:   </td>
                    <td><input type="text" color="black" name="pseudo" size="10" placeholder="Recherche..." /></td>
                    <a href=""><img src="images/loupe.png" width="20px" height="20px" alt="recherche" /></a>

                </table>
                </form>
            </div>

            <div class="convgauche">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href=" ">Prenom nom</a>
            </div>
       </div>

    <div class = "messages">
        <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
        <label>Prenom Nom</label>
        <hr>

        <div id="conv">
            <div class="conversationami">
            blablablabla
            </div>
            <div class="conversationmoi"></div>
        <hr>

        <form>
            <div id="ecrire">
                <textarea placeholder="Votre message..."></textarea>
                <button type="submit" class="btn btn-primary" class="btn btn-primary" value="Envoyer" float="right" width="7px" height="7px" >Envoyer</button>
            </div>
        </div>
        </form>
    </div>



</body>
</html>
