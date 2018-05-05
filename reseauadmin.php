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
        <form method="post" action="inscription.php?admin=true" class="typemembre">
            <label for="categorie">Ajouter un : </label>
            <select id="categorie" name="categorie">
                <option value="etu">étudiant</option>
                <option value="pro">professeur</option>
                <option value="par">partenaire</option>
                <option value="adm">administrateur</option>
            </select>

            <input type="submit" value="Ajouter">
        </form>

        <section id="murreseauadmin">
            <?php
                $req = $bdd->query(
                    "select pseudo,nom,prenom,fichier
                                from utilisateur
                                  left join multimedia on utilisateur.photo_profil = id"
                );

                while ($utilisateur = $req->fetch()) {
                    ?>
                    <article class="liencontact">
                        <img src="<?php echo ($utilisateur["fichier"] == null ? "images/profil.png" : "media/" . $utilisateur["fichier"]) ?>" width="60px" height="60px" alt="Photo de profil par défault"/>
                        <a href="profil.php?<?php echo http_build_query(["pseudo" => $utilisateur["pseudo"]]) ?>">
                            <?php echo htmlspecialchars($utilisateur['prenom'] . ' ' . $utilisateur['nom']) ?>
                        </a>
                        <div>
                            <img src="images/supprimer.png" width="30px" height="30px" alt="suppression"/>
                            <a href="modifierprofil.php?<?php echo http_build_query(["pseudo" => $utilisateur["pseudo"]]) ?>">
                                <img src="images/modifier.png" width="23px" height="23px" alt="modification"/></a>
                        </div>
                    </article>
                    <?php
                }
                $req->closeCursor();
            ?>
        </section>
    </div>
</div>
</body>
</html>
