<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 03/05/2018
 * Time: 04:35
 */
session_start();

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

// Récupération des infos utilisateur
$bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <link rel="stylesheet" href="css/style_general.css" />
    <link rel="stylesheet" href="css/style_menuhaut.css" />
    <link rel="stylesheet" href="css/style_notifications.css" />

    <title>Notifications</title>
</head>

<body>
<?php include("include/menuhaut.php") ?>

<div id="conteneur">
    <?php include("include/panneauprofil.php"); ?>
    <section id="murnotif">
        <article class="notif">

            <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification" />
            <div class="contenu">
                <p>Titre notif / demande d'ajout</p>
                <p>Contenu de la notification</p>
            </div>
            <p><a href="contenu_notif.php">Accepter la demande d'ajout</a></p>
        </article>
        <article class="notif">
            <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification" />
            <div class="contenu">
                <p>Titre notif / machin a accepté votre demande d'ajout</p>
                <p>Contenu de la notification</p>
            </div>

        </article>
        <article class="notif">
            <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification" />
            <div class="contenu">
                <p>Titre notif / machin a publié dans le fil d'actualité</p>
                <p>Contenu de la notification</p>
            </div>
            <p><a href="post_commentaire.php">Voir la publication (aller le fil d'actualité)</a></p>
        </article>

        <article class="notif">
            <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification" />
            <div class="contenu">
                <p>Titre notif / machin a aimé votre publication</p>
                <p>Contenu de la notification</p>
            </div>

        </article>

        <article class="notif">
            <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification" />
            <div class="contenu">
                <p>Titre notif / machin a commenté votre publication</p>
                <p>Contenu de la notification</p>
            </div>
            <p><a href="post_commentaire.php">Voir le commentaire</a></p>

        </article>


        <article class="notif">
            <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification" />
            <div class="contenu">
                <p>Titre notif / machin a partagé votre publication</p>
                <p>Contenu de la notification</p>
            </div>

        </article>

    </section>
</div>
</body>
</html>
