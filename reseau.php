<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 03/05/2018
 * Time: 04:17
 */
session_start();

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

// Récupération des infos utilisateur
$bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");
$req = $bdd->prepare(
    "select utilisateur.type as type,email,nom,prenom,fichier
                      from utilisateur left join multimedia on utilisateur.photo_profil = multimedia.id
                      where pseudo = ?"
);
$req->execute(array($_SESSION["pseudo"]));
$infos = $req->fetch();
$req->closeCursor();

// nombre de relations
$req = $bdd->prepare("select count(*) as nbrel from relation where utilisateur1 = :pseudo xor utilisateur2 = :pseudo");
$req->execute([":pseudo" => $_SESSION["pseudo"]]);
$nbrel = $req->fetch()['nbrel'];
$req->closeCursor();
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
            <?php include("include/panneauprofil.php"); ?>
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