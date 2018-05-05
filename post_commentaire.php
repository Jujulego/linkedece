<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 05/05/2018
 * Time: 04:06
 */
session_start();
include("include/notifications.php");

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

// Récupération du post
$bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");
$req = $bdd->prepare(
    "select post.id as id,date,auteur,message,multimedia,nom,prenom,fichier as photoprofil,poste
                from post
                  inner join publication on post.id=publication.post
                  inner join utilisateur on post.auteur = utilisateur.pseudo
                  left join multimedia on utilisateur.photo_profil = multimedia.id
                where post.id = ?
                order by date desc"
);
$req->execute(array(
    $_GET["post"]
));
$post = $req->fetch();
$req->closeCursor();

// Check partage
$req = $bdd->prepare("select jaime from partage where utilisateur = ? and publication = ?");
$req->execute(array(
    $_SESSION["pseudo"],
    $post["id"]
));

$partagee = $req->rowCount() != 0;
$aimee = $partagee ? $req->fetch()["jaime"] : false;

$req->closeCursor();

// Post ?
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $req = $bdd->prepare("insert into post values (null, ?, ?, current_timestamp)");
    $req->execute(array(
        $_POST["message"],
        $_SESSION["pseudo"]
    ));
    $req->closeCursor();

    $id = $bdd->lastInsertId();

    $req = $bdd->prepare("insert into commentaire values (?, ?)");
    $req->execute(array(
        $id,
        $_GET["post"]
    ));

    notif_comment($bdd, $_SESSION["pseudo"], $post["auteur"], $id);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />
        <link rel="stylesheet" href="css/style_posts.css" />
        <link rel="stylesheet" href="css/style_post_commentaire.css" />

        <title>Contenu du post</title>
    </head>

    <body>
        <?php include("include/menuhaut.php") ?>
        <div id="conteneur">
            <?php include("include/panneauprofil.php"); ?>

            <section id="murcom">
                <article class="publication">
                    <div class="postprofil">
                        <img src="<?php echo ($post["photoprofil"] == null ? "images/profil.png" : "media/" . $post["photoprofil"]) ?>" width="60px" height="60px"
                             alt="Photo de profil par défault"/>
                        <p>
                            <a href="profil.php?<?php echo http_build_query(["pseudo" => $post["auteur"]]) ?>">
                                <?php echo htmlspecialchars($post['prenom'] . ' ' . $post['nom']) ?>
                            </a>
                        </p>
                        <p>
                            <?php echo htmlspecialchars($post['poste']) ?></p>
                        <div>
                            <?php if ($aimee) {
                                ?>
                                <img src="images/aimebleu.png" width="30px" height="30px" alt="pouce j'aime">
                                <?php
                            } else if ($partagee) {
                                ?>
                                <img src="images/aime.png" width="30px" height="30px" alt="pouce j'aime">
                                <?php
                            } else {
                                ?>
                                <a href="partage.php?<?php echo http_build_query([
                                    "post" => $post["id"],
                                    "like" => 1
                                ]); ?>">
                                    <img src="images/aime.png" width="30px" height="30px" alt="pouce j'aime">
                                </a>
                                <?php
                            }
                            ?>

                            <a href="post_commentaire.php?<?php echo http_build_query(["post" => $post["id"]]); ?>">
                                <img src="images/commentaire.png" width="30px" height="30px" alt="commentaire" >
                            </a>

                            <?php if ($partagee) {
                                ?>
                                <img src="images/partagebleu.png" width="30px" height="30px" alt="commentaire">
                                <?php
                            } else {
                                ?>
                                <a href="partage.php?<?php echo http_build_query([
                                    "post" => $post["id"]
                                ]); ?>">
                                    <img src="images/partage.png" width="30px" height="30px" alt="commentaire">
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <hr />
                    <div class="post">
                        <?php
                        if ($post["multimedia"] != null) {
                            // Récupération des infos image
                            $req = $bdd->prepare("select fichier,type from multimedia where id = ?");
                            $req->execute(array($post["multimedia"]));

                            $image = $req->fetch();

                            $req->closeCursor();

                            if ($image["type"] == "img") {
                                ?>
                                <img src="<?php echo "media/" . $image["fichier"]; ?>"/>
                                <?php
                            } else {
                                ?>
                                <video controls src="<?php echo "media/" . $image["fichier"]; ?>"></video>
                                <?php
                            }
                        }
                        ?>
                        <p><?php echo htmlspecialchars($post['message']) ?></p>
                    </div>
                </article>

                <article class="commentaire">
                    <div class="commentprofil"></div>
                    <hr />
                    <form method="post" class="commentcontenu">
                        <textarea name="message" placeholder="Commentez !"></textarea>
                        <input type="submit" value="Envoyer" />
                    </form>
                </article>

                <?php
                    $req = $bdd->prepare(
                        "select post.id as id,message,nom,auteur,prenom
                                    from post
                                      inner join commentaire on post.id=commentaire.post
                                      inner join utilisateur on post.auteur = utilisateur.pseudo
                                    where cible = ?
                                    order by date desc");
                    $req->execute(array(
                        $_GET["post"]
                    ));
                    while ($comm = $req->fetch()) {
                        ?>
                        <article class="commentaire" id="<?php echo $comm["id"]; ?>">
                            <div class="commentprofil">
                                <p>
                                    <a href="profil.php?<?php echo http_build_query(["pseudo" => $comm["auteur"]]) ?>">
                                        <?php echo htmlspecialchars($comm['prenom'] . ' ' . $comm['nom']) ?>
                                    </a>
                                </p>
                            </div>
                            <hr/>
                            <div class="commentcontenu">
                                <p><?php echo $comm["message"]; ?></p>
                            </div>
                        </article>
                        <?php
                    }
                ?>
            </section>
        </div>
    </body>
</html>