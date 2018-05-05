<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 03/05/2018
 * Time: 04:35
 */
session_start();
include("include/notifications.php");

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

// Récupération des infos utilisateur
$bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");
    accepter_ami($bdd, $_POST["notif"], $_SESSION["pseudo"], $_POST["pseudo"]);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />
        <link rel="stylesheet" href="css/style_notifications.css" />

        <title>Notifications</title>
    </head>

    <body>
        <?php include("include/menuhaut.php") ?>

        <div id="conteneur">
            <?php include("include/panneauprofil.php"); ?>

            <section id="murnotif">
                <?php
                    $req = $bdd->prepare(
                        "select id,emetteur,cible,type,post
                                    from notification
                                    where cible = ?
                                    order by date desc");
                    $req->execute(array(
                        $_SESSION["pseudo"]
                    ));

                    while ($notif = $req->fetch()) {
                        switch ($notif["type"]) {
                            case 'da':
                                ?>
                                <article class="notif">
                                    <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification"/>
                                    <div class="contenu">
                                        <p><?php echo $notif["emetteur"]; ?> vous demande en ami</p>
                                    </div>
                                    <form method="post">
                                        <input type="hidden" name="pseudo" value="<?php echo $notif["emetteur"]; ?>">
                                        <input type="hidden" name="notif" value="<?php echo $notif["id"]; ?>">
                                        <input type="submit" value="Accepter la demande d'ajout" />
                                    </form>
                                </article>
                                <?php
                                break;

                            case 'aa':
                                ?>
                                <article class="notif">
                                    <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification"/>
                                    <div class="contenu">
                                        <p><?php echo $notif["emetteur"]; ?> a accepté votre demande d'ajout</p>
                                    </div>

                                </article>
                                <?php
                                break;

                            case 'pu':
                                ?>
                                <article class="notif">
                                    <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification"/>
                                    <div class="contenu">
                                        <p><?php echo $notif["emetteur"]; ?> a publié dans le fil d'actualité</p>
                                    </div>
                                    <p><a href="post_commentaire.php?<?php echo http_build_query(["post" => $notif["post"]]) ?>">Voir la publication (aller le fil d'actualité)</a></p>
                                </article>
                                <?php
                                break;

                            case 'li':
                                ?>
                                <article class="notif">
                                    <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification"/>
                                    <div class="contenu">
                                        <p><?php echo $notif["emetteur"]; ?> a aimé votre publication</p>
                                    </div>

                                </article>
                                <?php
                                break;

                            case 'co':
                                $reqc = $bdd->prepare("select cible from commentaire where post = ?");
                                $reqc->execute(array($notif["post"]));
                                $comm = $reqc->fetch();
                                $reqc->closeCursor();

                                ?>
                                <article class="notif">
                                    <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification"/>
                                    <div class="contenu">
                                        <p><?php echo $notif["emetteur"]; ?> a commenté votre publication</p>
                                    </div>
                                    <p><a href="post_commentaire.php?<?php echo http_build_query(["post" => $comm["cible"]]) . '#' . $notif["post"] ?>">Voir le commentaire</a></p>

                                </article>
                                <?php
                                break;

                            case 'pa':
                                ?>
                                <article class="notif">
                                    <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification"/>
                                    <div class="contenu">
                                        <p><?php echo $notif["emetteur"]; ?> a partagé votre publication</p>
                                    </div>

                                </article>
                            <?php
                        }
                    }

                    $req->closeCursor();
                ?>
            </section>
        </div>
    </body>
</html>
