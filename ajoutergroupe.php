<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 05/05/2018
 * Time: 11:36
 */
session_start();

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

// Envoi du formulaire ?
$bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["pseudo"], $_GET["groupe"])) {
    // Ajout au groupe
    $req = $bdd->prepare("insert into groupeutilisateur values (null, ?, ?)");
    $req->execute(array(
        $_GET["groupe"],
        $_POST["pseudo"]
    ));
    $req->closeCursor();
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
                                      inner join (select utilisateur2 as utilisateur from relation where utilisateur1 = :pseudo
                                            union select utilisateur1 as utilisateur from relation where utilisateur2 = :pseudo)
                                        as amis on amis.utilisateur = pseudo
                                      left join multimedia on photo_profil = id
                                    where pseudo not in (select utilisateur from groupeutilisateur where groupe = :groupe)"
                    );
                    $req->execute([
                        "pseudo" => $_SESSION["pseudo"],
                        "groupe" => $_GET["groupe"]
                    ]);

                    while ($ami = $req->fetch()) {
                        ?>
                        <form method="post" class="liencontact">
                            <input type="hidden" name="pseudo" value="<?php echo $ami["pseudo"]; ?>" />
                            <img src="<?php echo ($ami["fichier"] == null ? "images/profil.png" : "media/" . $ami["fichier"]) ?>" width="60px" height="60px" alt="Photo de profil par défault"/>
                            <a href="profil.php?<?php echo http_build_query(["pseudo" => $ami["pseudo"]]) ?>">
                                <?php echo htmlspecialchars($ami['prenom'] . ' ' . $ami['nom']) ?>
                            </a>
                            <input type="submit" value="Ajouter au groupe" />
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