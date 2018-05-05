<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 04/05/2018
 * Time: 17:17
 */
session_start();
include("include/notifications.php");

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");
    demande_ami($bdd, $_SESSION["pseudo"], $_POST["pseudo"]);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="css/style_ajout_reseau.css" />
        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />

        <title>Réseau</title>
    </head>

    <body>
        <?php include("include/menuhaut.php") ?>
        <div id="conteneur">
            <?php include("include/panneauprofil.php") ?>
            <div>
                <section id="murreseau">
                    <?php
                    $req = $bdd->prepare(
                        "select pseudo,nom,prenom,fichier
                                    from utilisateur
                                      left join multimedia on photo_profil=id
                                    where pseudo not in (select utilisateur1 as ami
                                                           from relation
                                                           where utilisateur2 = :pseudo
                                                             xor utilisateur1 = :pseudo
                                                   union select utilisateur2 as ami
                                                           from relation
                                                           where utilisateur1 = :pseudo
                                                             xor utilisateur2 = :pseudo)
                                    order by rand()
                                    limit 20"
                    );
                    $req->execute(["pseudo" => $_SESSION["pseudo"]]);

                    while ($ami = $req->fetch()) {
                        ?>
                        <form method="post" class="liencontact">
                            <input type="hidden" name="pseudo" value="<?php echo $ami["pseudo"]; ?>" />
                            <img src="<?php echo ($ami["fichier"] == null ? "images/profil.png" : "media/" . $ami["fichier"]) ?>" width="60px" height="60px" alt="Photo de profil par défault"/>
                            <a href="profil.php?<?php echo http_build_query(["pseudo" => $ami["pseudo"]]) ?>">
                                <?php echo htmlspecialchars($ami['prenom'] . ' ' . $ami['nom']) ?>
                            </a>
                            <input type="submit" value="Ajouter à mon réseau">
                        </form>
                        <?php
                    }
                    $req->closeCursor();
                    ?>
                </section>
            </div>
        </div>
    </body>
</html>