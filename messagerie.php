<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 03/05/2018
 * Time: 15:40
 */
session_start();

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

// Récupération des groupes
$bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_GET["id"]) && isset($_POST["message"])) {
        // Envoi d'un message
        $req = $bdd->prepare(
            "insert into message values (null, ?, ?, ?, current_timestamp)"
        );
        $req->execute(array(
            $_GET["id"],
            $_SESSION["pseudo"],
            $_POST["message"]
        ));
        $req->closeCursor();
    } else if (isset($_POST["nom"])) {
        // Création d'un groupe
        $req = $bdd->prepare(
            "insert into groupe values (null, ?)"
        );
        $req->execute(array(
            $_POST["nom"]
        ));
        $req->closeCursor();
        $groupeid = $bdd->lastInsertId();

        // Ajout de l'utilisateur au groupe
        $req = $bdd->prepare(
            "insert into groupeutilisateur values (null, ?, ?)"
        );
        $req->execute(array(
            $groupeid,
            $_SESSION["pseudo"],
        ));
        $req->closeCursor();
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="refreshmessagerie.js"></script>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="css/style_accueil.css" />
        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />
        <link rel="stylesheet" href="css/style_messagerie.css" />

        <title>Messagerie</title>
    </head>
    <body>
        <?php include("include/menuhaut.php") ?>

        <div id="conteneur">
            <div id="groupes">
                <h3>Groupes</h3>
                <?php
                $req = $bdd->prepare(
                    "select groupe.id,nom
                                from groupe
                                  inner join groupeutilisateur on groupe.id = groupeutilisateur.groupe
                                where utilisateur = ?"
                );
                $req->execute(array($_SESSION["pseudo"]));

                while ($groupe = $req->fetch()) {
                    ?>
                    <div class="groupe">
                        <a href="messagerie.php?<?php echo http_build_query(["id" => $groupe["id"]]); ?>"><?php echo $groupe["nom"]; ?></a>
                    </div>
                    <?php
                }
                $req->closeCursor();
                ?>
                <form method="post">
                    <input type="text" title="nom" name="nom" placeholder="Nom" />
                    <input type="submit" value="Créer" />
                </form>
            </div>

            <div id="messages">
                <?php
                    if (isset($_GET["id"])) {
                        // Récupération du nom
                        $req = $bdd->prepare(
                            "select nom
                                from groupe
                                where id = ?"
                        );
                        $req->execute(array($_GET["id"]));
                        $groupe = $req->fetch()["nom"];
                        $req->closeCursor();

                        // Récupération des messages
                        $req = $bdd->prepare(
                            "select message,auteur
                                        from message
                                        where groupe=?
                                        order by date asc
                                        limit 20"
                        );
                        $req->execute(array($_GET["id"]));

                        ?>
                        <p>Groupe : <?php echo $groupe; ?><a href="ajoutergroupe.php?<?php echo http_build_query(["groupe" => $_GET["id"]]); ?>">Inviter</a></p>
                        <hr/>
                        <div id="conv">
                            <?php
                                while ($message = $req->fetch()) {
                                    ?>
                                    <p class="<?php echo $message["auteur"] == $_SESSION["pseudo"] ? "conversationmoi" : "conversationami"; ?>">
                                        <?php echo $message["auteur"] . ": " . $message["message"]; ?>
                                    </p>
                                    <?php
                                }
                            ?>
                        </div>
                        <hr/>
                        <form method="post">
                            <div id="ecrire">
                                <textarea placeholder="Votre message..." name="message"></textarea>
                                <input type="submit" class="btn btn-primary" class="btn btn-primary" value="Envoyer" />
                            </div>
                        </form>
                        <?php
                    }
                ?>
            </div>
        </div>
    </body>
</html>
