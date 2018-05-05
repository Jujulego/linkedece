<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 05/05/2018
 * Time: 04:06
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="css/style_general.css" />
    <link rel="stylesheet" href="css/style_menuhaut.css" />
    <link rel="stylesheet" href="css/style_post_commentaire.css" />


    <title>Contenu du post</title>
</head>

<body>
<?php include("include/menuhaut.php") ?>

<div id="conteneur">
    <?php include("include/panneauprofil.php"); ?>

    <section id="murcom">
        <article class="box">

                <div class="contenupost">
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil apr défaut" />
                    <p>Prenom Nom</p>
                </div>

                <div class="contenu">

                    <p>Post / publication</p>
                </div>

        </article>
        <article>
            <div class="commentaire">
                <p><a href="#page_profil_commentateur">Prenom Nom</a> : Contenu du commentaire</p>
            </div>
        </article>
        <article>
            <div class="commentaire">
                <p><a href="#page_profil_commentateur">Prenom Nom</a> : Contenu du commentaire</p>
            </div>
        </article>
        <article>
            <div class="commentaire">
                <p><a href="#page_profil_commentateur">Prenom Nom</a> : Contenu du commentaire</p>
            </div>
        </article>
        <article>
            <div class="commentaire">
                <p><a href="#page_profil_commentateur">Prenom Nom</a> : Contenu du commentaire</p>
            </div>
        </article>
        <article>
            <div class="commentaire">
                <p><a href="#page_profil_commentateur">Prenom Nom</a> : Contenu du commentaire</p>
            </div>
        </article>
        <article>
            <div class="commentaire">
                <p><a href="#page_profil_commentateur">Prenom Nom</a> : Contenu du commentaire</p>
            </div>
        </article>




    </section>
</div>
</body>
</html>