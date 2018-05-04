<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 02/05/2018
 * Time: 11:33
 */

session_start();

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

function texteAleatoire($longueur) {
    $texte = "";

    for ($i = 0; $i < $longueur; ++$i) {
        $texte .= dechex(mt_rand(0, 15));
    }

    return $texte;
}

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

// Envoi du formulaire ?
$envoye = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $envoye = true;

    if (isset($_POST["message"]) && $_POST["message"] != "") {
        $req = $bdd->prepare("insert into post values (null, ?, ?, current_timestamp)");
        $req->execute(array($_POST["message"], $_SESSION["pseudo"]));
        $id = $bdd->lastInsertId();

        // Un fichier qui est une image ou une video
        $idmultimedia = null;
        if (isset($_FILES["multimedia"])
            && ($_FILES["multimedia"]["error"] == 0)
            && preg_match("#image|video#", $_FILES["multimedia"]["type"])) {

            // type de fichier
            if (preg_match("#image#", $_FILES["multimedia"]["type"])) {
                $type = "img";
            } else {
                $type = "vid";
            }

            // Sauvegarde
            $fichier = texteAleatoire(20) . '.' . pathinfo($_FILES["multimedia"]["name"])["extension"];
            move_uploaded_file($_FILES["multimedia"]["tmp_name"], "media/" . $fichier);

            // Base de données
            $req = $bdd->prepare("insert into multimedia values (null, ?, ?, current_timestamp, ?)");
            $req->execute(array(
                $type,
                $fichier,
                isset($_POST["lieu"]) ? $_POST["lieu"] : null
            ));

            $idmultimedia = $bdd->lastInsertId();
        }

        // publication
        $req = $bdd->prepare("insert into publication values (?, ?, ?, ?)");
        $req->execute(array(
            $id,
            isset($_POST["lieu"]) ? $_POST["lieu"] : null,
            $_POST["confidentialite"] == "true",
            $idmultimedia
        ));

        $envoye = false;
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="css/style_accueil.css" />
        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />
        <link rel="stylesheet" href="css/style_posts.css" />

        <title>Accueil</title>
    </head>

    <body>
        <?php include("include/menuhaut.php") ?>

        <div id="conteneur">
            <?php include("include/panneauprofil.php"); ?>

            <section id="mur">
                <article id="status" class="publication">
                    <div class="postprofil">
                        <img src="<?php echo ($infos["fichier"] == null ? "images/profil.png" : "media/" . $infos["fichier"]) ?>" width="60px" height="60px" alt="Photo de profil par défault" />
                        <p><?php echo htmlspecialchars($infos['prenom'] . ' ' . $infos['nom']) ?></p>
                    </div>
                    <hr>

                    <form method="post" enctype="multipart/form-data">
                        <textarea name="message" title="message" placeholder="Votre publication ..."><?php
                            if ($envoye && isset($_POST["message"])) echo htmlspecialchars($_POST["message"]);
                        ?></textarea>

                        <div id="statusinfos">
                            <div>
                                <label for="lieu"><img src="images/logolieu.png" width="30px" height="30px" /></label>
                                <input id="lieu" name="lieu" type="text" value="<?php if ($envoye && isset($_POST["lieu"])) echo $_POST["lieu"]; ?>" placeholder="Lieu" />
                            </div>
                            <div class="statusmultimedia">
                                <label for="multimedia">Photo / Vidéo</label>
                                <input type="file" id="multimedia" name="multimedia" value="<?php if ($envoye && isset($_FILES["multimedia"])) echo $_FILES["multimedia"]["name"]; ?>" />
                                <p>Taille max : 8Mo</p>
                            </div>
                            <div>
                                <select name="confidentialite" title="confidentialite">
                                    <option value="true">Public</option>
                                    <option value="false" <?php if ($envoye && isset($_POST["confidentialite"]) && $_POST["confidentialite"] == "false") echo "selected"; ?>>Relations</option>
                                </select>
                                <input type="submit" width="10px" height="10px" value="Publier" >
                            </div>
                        </div>
                    </form>
                </article>

                <?php
                    $posts = $bdd->prepare(
                        "select post.id as id,date,auteur,message,multimedia,nom,prenom,fichier as photoprofil
                                    from post
                                      inner join publication on post.id=publication.post
                                      inner join utilisateur on post.auteur = utilisateur.pseudo
                                      left join multimedia on utilisateur.photo_profil = multimedia.id
                                    where auteur = :pseudo -- de l'utilisateur
                                      xor auteur in ( -- de ses amis (partie 1)
                                              select utilisateur1 as utilisateur
                                                from relation
                                                where utilisateur2 = :pseudo
                                          )
                                      xor auteur in ( -- de ses amis (partie 2)
                                              select utilisateur2
                                                from relation
                                                where utilisateur1 = :pseudo
                                          )
                                    order by date desc"
                    );
                    $posts->execute([":pseudo" => $_SESSION["pseudo"]]);
                    include("include/posts.php");
                    $posts->closeCursor();
                ?>
            </section>
        </div>
    </body>
</html>