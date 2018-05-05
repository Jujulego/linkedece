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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="css/style_reseau.css" />
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
                <section id="murreseau">
                    <?php
                        $req = $bdd->prepare(
                        "select pseudo,nom,prenom,fichier
                                    from utilisateur
                                      inner join (select utilisateur2 as utilisateur from relation where utilisateur1 = :pseudo
                                            union select utilisateur1 as utilisateur from relation where utilisateur2 = :pseudo)
                                        as amis on amis.utilisateur = pseudo
                                    left join multimedia on photo_profil = id"
                        );
                        $req->execute(["pseudo" => $_SESSION["pseudo"]]);

                        while ($amis = $req->fetch()) {
                            ?>
                            <article class="liencontact">
                                <img src="<?php echo ($amis["fichier"] == null ? "images/profil.png" : "media/" . $amis["fichier"]) ?>" width="60px" height="60px" alt="Photo de profil par défault"/>
                                <a href="profil.php?<?php echo http_build_query(["pseudo" => $amis["pseudo"]]) ?>">
                                    <?php echo htmlspecialchars($amis['prenom'] . ' ' . $amis['nom']) ?>
                                </a>
                            </article>
                            <?php
                        }
                    ?>
                </section>
            </div>
        </div>
    </body>
</html>