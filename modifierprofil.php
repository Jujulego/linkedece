<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 03/05/2018
 * Time: 18:38
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
$req = $bdd->prepare("select pseudo,email,nom,prenom from utilisateur where pseudo = ?");
$req->execute(array($_SESSION["pseudo"]));
$infos = $req->fetch();
$req->closeCursor();

// Envoi du formulaire !!!
$envoye = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $envoye = true;

    // Gestion des champs
    if (isset($_POST["email"]) && ($_POST["email"] != $infos["email"])) {
        $infos["email"] = $_POST["email"];
    }

    if (isset($_POST["nom"]) && ($_POST["nom"] != $infos["nom"])) {
        $infos["nom"] = $_POST["nom"];
    }

    if (isset($_POST["prenom"]) && ($_POST["prenom"] != $infos["prenom"])) {
        $infos["prenom"] = $_POST["prenom"];
    }

    // Photo de profil
    $idmultimedia = null;
    if (isset($_FILES["imageprofil"])) {
        // Sauvegarde
        $fichier = texteAleatoire(20) . '.' . pathinfo($_FILES["imageprofil"]["name"])["extension"];
        move_uploaded_file($_FILES["imageprofil"]["tmp_name"], "media/" . $fichier);

        // Base de données
        $req = $bdd->prepare("insert into multimedia values (null, 'img', ?, current_timestamp, null)");
        $req->execute(array(
            $fichier
        ));

        $idmultimedia = $bdd->lastInsertId();
    }

    // Modification !!!
    if (!isset($erreur)) {
        $req = $bdd->prepare("update utilisateur set nom = ?, prenom = ?, email = ?, photo_profil = ? where pseudo = ?");
        $req->execute(array(
            $infos["nom"],
            $infos["prenom"],
            $infos["email"],
            $idmultimedia,
            $_SESSION["pseudo"]
        ));
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />
        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_modifierprofil.css" />
        <title>Modifier profil</title>
    </head>
    <body>
        <?php include("include/menuhaut.php") ?>
        <div id="menugauche">
            <?php
             if (isset($erreur)) {
                 ?>
                 <p id="erreur"><?php echo $erreur; ?></p>
                <?php
             }
            ?>
            <form enctype="multipart/form-data" method="post">
                <input type="file" accept="image/*" name="imageprofil" />

                <table>
                    <tr>
                        <td><label for="pseudo">Pseudo :</label></td>
                        <td><?php echo $infos["pseudo"]; ?></td>
                        <td><label for="email">Email :</label></td>
                        <td><input id="email" type="text" name="nom" value="<?php echo $infos["email"]; ?>" /></td>
                    </tr>
                    <tr>
                        <td><label for="prenom">Prénom :</label></td>
                        <td><input id="prenom" type="text" name="prenom" value="<?php echo $infos["prenom"]; ?>" /></td>
                        <td><label for="nom">Nom :</label></td>
                        <td><input id="nom" type="text" name="nom" value="<?php echo $infos["nom"]; ?>" /></td>
                    </tr>
                    <tr>
                        <td><label for="secteur">Secteur :</label></td>
                        <td><input id="secteur" type="text" name="secteur"/></td>
                        <td><label for="poste">Poste actuel :</label></td>
                        <td><input id="poste" type="text" name="poste" /></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td><input type="submit" value="Enregistrer les modifications" ></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
