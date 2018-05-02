<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 02/05/2018
 * Time: 11:33
 */
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
                    <div id="post">
                        <img src="profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                        <p>Prenom Nom</p>
                        <div class="posteact"><p>Poste actuel</p></div>
                    </div>
                </article>
                <article>
                    <img src="profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <p>Prenom Nom</p>

                </article>
                    <div id="actionpost" >
                        <div class= butpost><input type="button" value="j'aime"></div>
                        <a href="http://ton lien"><img src="pouce j'aime.png" alt= "nom de ton image"></a>
                        <div class= butpost><input type="button" value="commenter"></div>
                        <div class= partager><input type="button" value="partager"></div>
                    </div>

                <article>
                    <img src="profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <p>Prenom Nom</p>
                </article>
            </section>
        </div>
    </body>
</html>