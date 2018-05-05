<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 04/05/2018
 * Time: 09:32
 */
session_start();
include("include/notifications.php");

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

// Connexion à la base de données
$bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");

// Type ?
$req = $bdd->prepare("select type from utilisateur where pseudo = ?");
$req->execute(array($_SESSION["pseudo"]));
$type = $req->fetch()["type"];
$admin = $type == "adm";
$etudiant = $type == "etu";
$partenaire = $type == "par";
$req->closeCursor();

// Envoi de formulaire
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["offre"], $_POST["auteur"])) {
        // Un postulant !
        $req = $bdd->prepare("insert into postulation values (null, ?, ?)");
        $req->execute(array(
            $_SESSION["pseudo"],
            $_POST["offre"]
        ));
        $req->closeCursor();

        notif_postuler($bdd, $_SESSION["pseudo"], $_POST["auteur"], $_POST["offre"]);
    } else if (isset($_POST["poste"], $_POST["entreprise"], $_POST["secteur"])) {
        // Une offre !
        $req = $bdd->prepare("insert into offre values (null, current_timestamp, ?, ?, ?, ?, false)");
        $req->execute(array(
            $_SESSION["pseudo"],
            $_POST["poste"],
            $_POST["entreprise"],
            $_POST["secteur"]
        ));
        $req->closeCursor();
    }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="css/style_profil.css" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />
        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_emplois.css" />

        <title>Modifier votre experience</title>
    </head>
    <body>
        <?php include("include/menuhaut.php") ?>

        <div id="conteneur">
            <?php include("include/panneauprofil.php"); ?>

            <div>
                <h1>Offres d'emplois disponibles</h1>
                <section id="murreseau" class="notifmur">
                    <?php
                    if ($partenaire or $admin) {
                        ?>
                        <form method="post">
                            <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification"/>

                            <div class="poste"><input type="text" name="poste" placeholder="Poste" /></div>
                            <div class="entreprise"><input type="text" name="entreprise" placeholder="Entreprise" /></div>
                            <div class="secteur"><input type="text" name="secteur" placeholder="Secteur" /></div>

                            <input type="submit" class="btn btn-primary" value="Ajouter"/>
                        </form>
                        <?php
                    }
                    ?>
                    <?php
                        $req = $bdd->query(
                            "select id,poste,entreprise,secteur,auteur
                                        from offre
                                        where not acceptee
                                        order by date desc"
                        );

                        while ($offre = $req->fetch()) {
                            ?>
                            <form method="post">
                                <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification"/>

                                <div class="poste"><label>Poste: </label><?php echo htmlspecialchars($offre["poste"]); ?></div>
                                <div class="entreprise"><label>Entreprise: </label><?php echo htmlspecialchars($offre["entreprise"]); ?></div>
                                <div class="secteur"><label>Secteur: </label><?php echo htmlspecialchars($offre["secteur"]); ?></div>
                                <div class="auteur"><a href="profil.php?<?php echo http_build_query(["pseudo" => $offre["auteur"]]) ?>"><?php echo htmlspecialchars($offre["auteur"]); ?></a></div>

                                <?php
                                    if ($etudiant or $admin) {
                                        ?>
                                        <input type="hidden" name="offre" value="<?php echo $offre["id"]; ?>" />
                                        <input type="hidden" name="auteur" value="<?php echo $offre["auteur"]; ?>" />
                                        <input type="submit" class="btn btn-primary" value="Postuler" />
                                        <?php
                                    }
                                ?>
                            </form>
                            <?php
                        }
                    ?>
                </section>
            </div>
        </div>
    </body>
</html>

