<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 04/05/2018
 * Time: 22:33
 */
session_start();


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

    <link rel="stylesheet" href="css/style_reseau.css" />
    <link rel="stylesheet" href="css/style_reseauadmin.css" />
    <link rel="stylesheet" href="css/style_general.css" />
    <link rel="stylesheet" href="css/style_menuhaut.css" />

    <title>Réseau</title>
</head>

<body>
<?php include("include/menuhaut.php") ?>

<div id="conteneur">
    <?php include("include/panneauprofil.php"); ?>
    <div id="supermur">
        <p id="btnajout">
            <a href="ajoutreseau.php">Ajouter des relations</a>
        </p>
        <p id="btnajoutuser">
            <a href="inscription.php" value="Inscription">Ajouter </a>
        </p>
        <p>
            <form method="post" action="inscription.php" class="typemembre">
            <p>
                <label for="categorie">Ajouter un : </label>
                <select id="categorie" name="categorie">
                    <option value="etu">étudiant</option>
                    <option value="pro">professeur</option>
                    <option value="par">partenaire</option>
                </select>
            </p>

        </form>
        </p>
        <section id="murreseauadmin">
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
                <img src="images/supprimer.png" width="30px" height="30px" alt="Photo de notification" />
                <div class="modifier">
                    <a hred="modifierprofil.php">
                        <img src="images/modifier.png" width="23px" height="23px" alt="Photo de notification" />
                    </a>
                </div>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
            <article class="liencontact">
                <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                <a href="#page de profil du contact">Prenom Nom</a>
            </article>
        </section>
    </div>
</div>
</body>
</html>
