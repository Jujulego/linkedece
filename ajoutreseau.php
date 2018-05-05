<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 04/05/2018
 * Time: 17:17
 */
session_start();

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
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

                while ($amis = $req->fetch()) {
                    ?>
                    <article class="liencontact">
                        <img src="<?php echo ($amis["fichier"] == null ? "images/profil.png" : "media/" . $amis["fichier"]) ?>" width="60px" height="60px" alt="Photo de profil par défault"/>
                        <a href="profil.php?<?php echo http_build_query(["pseudo" => $amis["pseudo"]]) ?>">
                            <?php echo htmlspecialchars($amis['prenom'] . ' ' . $amis['nom']) ?>
                        </a>
                        <input type="button" value="Ajouter à mon réseau">
                    </article>
                    <?php
                }
                ?>
            </section>
        </div>
    </body>
</html>