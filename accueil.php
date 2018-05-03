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
<html xmlns="http://www.w3.org/1999/html">
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
                        <div id="butstatut">
                            <div class="butstatut1"> <a href="http://ton lien"><img src="images/ajoutimage.png".png" width="40px" height="38px" alt= "ajout images"></a></div>
                            <div class="butstatut1"> <a href="http://ton lien"><img src="images/ajoutvideo.png" width="35px" height="38px" alt= "ajout vidéos"></a></div>

                        </div>

                    </div>
                    <table>
                        <tr>
                            <td>
                                <a href="http://ton lien"><img src="images/logolieu.png" width="30px" height="30px" alt= "lieu"/></a>
                            </td>
                            <td>
                                <input type="text" name="lieu" size="10" />

                            </td>

                            <td>
                                <label>Ressenti: </label>
                            </td>
                            <td>
                                <input type="text" name="lieu" size="10" />
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <div class="butstatut2">
                    <SELECT name="confidentialité" size="1">
                        <OPTION>Public
                        <OPTION>Relation
                    </SELECT>
                        <input type="button" float="right" width="10px" height="10px" value="Publier" >
                    </div>
                </article>

                <article>
                    <div id="post">
                        <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                        <p>Prenom Nom</p>
                        <div class="posteact">
                            <p>Poste actuel</p>
                        </div>
                        <div class="lien">
                        <a href="http://ton lien"><img src="images/aime.png" width="30px" height="30px" alt= "pouce j'aime"></a>
                        <a href="http://ton lien"><img src="images/commentaire.png"  width="30px" height="30px" alt= "commentaire"></a>
                        </div>
                        <div class ="lienpartage">
                            <a href="http://ton lien">
                                <img src="images/partagebleu.png"  width="30px" height="30px" alt= "partage">
                            </a>
                        </div>

                     </div>

                </article>

                <article>
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <p>Prenom Nom</p>
                </article>
            </section>
        </div>
    </body>
</html>