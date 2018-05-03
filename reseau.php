<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 03/05/2018
 * Time: 04:17
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="css/style_accueil.css" />
    <link rel="stylesheet" href="css/style_general.css" />
    <link rel="stylesheet" href="css/style_menuhaut.css" />

    <title>Réseau</title>
</head>

<body>
<?php include("include/menuhaut.php") ?>

<div id="conteneur">
    <section id="profil">
        <img src="images/profil.png" width="100px" height="100px" alt="Photo de profil par défault" />
        <p>Prénom Nom</p>
        <p>Titre</p>
        <p>Email</p>
        <p>50 relations</p>
    </section>

    <section id="mur">
        <article>
            <div id="post">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <p>Prenom Nom</p>

                <textarea  style="width: 300px;height:100px" >Votre statut...</textarea>
            </div>
        </article>
        <article>
            <div id="post">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <p>Prenom Nom</p>
                <div class="posteact"><p>Poste actuel</p></div>
            </div>
            <a href="http://ton lien"><img src="images/pouce j'aime.png" width="30px" height="30px" alt= "pouce j'aime"></a>
            <a href="http://ton lien"><img src="images/commentaire.png" width="30px" height="30px" alt= "commentaire"></a>
            <a href="http://ton lien"><img src="images/partagebleu.png" width="30px" height="30px" alt= "commentaire"></a>
        </article>

        <article>
            <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
            <p>Prenom Nom</p>
        </article>
    </section>
</div>
</body>
</html>