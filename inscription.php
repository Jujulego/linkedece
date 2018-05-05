<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 02/05/2018
 * Time: 14:38
 */
session_start();

// catégorie sélectionnée ?
if (!isset($_POST["categorie"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

// Inscription
$pseudo_existant = false;

if (isset($_POST["pseudo"], $_POST["email"], $_POST["mot_de_passe"], $_POST["nom"], $_POST["prenom"], $_POST["naissance"], $_POST["poste"], $_POST["secteur"])) {
    // connexion à la base de données
    $bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");

    // Requete d'ajout
    $req = $bdd->prepare("insert into utilisateur values (?, ?, ?, ?, ?, ?, ?, ?, ?, null, null)");
    $req->execute(array(
        $_POST["pseudo"],
        $_POST["email"],
        password_hash($_POST["mot_de_passe"], PASSWORD_BCRYPT),
        $_POST["categorie"],
        $_POST["nom"],
        $_POST["prenom"],
        $_POST["naissance"],
        $_POST["poste"],
        $_POST["secteur"]
    ));

    if ($req->errorCode() == 0) {
        if (isset($_GET["admin"])) {
            header("Location: reseauadmin.php", true, 303);
            exit();
        } else {
            // Connecté !!!
            $_SESSION['pseudo'] = $_POST['pseudo'];
            header("Location: accueil.php", true, 303);
            exit();
        }
    } else {
        $req = $bdd->prepare("select * from utilisateur where pseudo=?");
        $req->execute(array($_POST["pseudo"]));

        $pseudo_existant = $req->rowCount() != 0;

        $req->closeCursor();
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Inscription</title>
    </head>
    <body>
        <h1>Inscription
            <?php
                switch ($_POST["categorie"]) {
                    case 'etu':
                        echo "étudiant";
                        break;
                    case 'pro':
                        echo "professeur";
                        break;
                    case 'par':
                        echo "partenaire";
                        break;
                }
            ?>
        </h1>

        <form method="post">
            <input type="hidden" name="categorie" value="<?php echo $_POST["categorie"] ?>" />
            <input type="hidden" name="rempli" value="true" />
            
            <table>
                <tr>
                    <td><label for="pseudo">Pseudo</label></td>
                    <td><input id="pseudo" type="text" name="pseudo" value="<?php if (isset($_POST["pseudo"])) { echo $_POST["pseudo"]; } ?>" /></td>
                    <?php
                        if (isset($_POST["rempli"]) && !isset($_POST["pseudo"])) {
                    ?>
                            <td><p>Champ obligatoire</p></td>
                    <?php
                        } else if ($pseudo_existant) {
                    ?>
                            <td><p>Pseudo existant</p></td>
                    <?php
                        }
                    ?>
                </tr>
                <tr>
                    <td><label for="email">E-Mail</label></td>
                    <td><input id="email" type="text" name="email" value="<?php if (isset($_POST["email"])) { echo $_POST["email"]; } ?>" /></td>
                    <?php
                    if (isset($_POST["rempli"]) && !isset($_POST["email"])) {
                        ?>
                        <td><p>Champ obligatoire</p></td>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <td><label for="mot_de_passe">Mot de passe</label></td>
                    <td><input id="mot_de_passe" type="password" name="mot_de_passe" value="<?php if (isset($_POST["mot_de_passe"])) { echo $_POST["mot_de_passe"]; } ?>" /></td>
                    <?php
                    if (isset($_POST["rempli"]) && !isset($_POST["mot_de_passe"])) {
                        ?>
                        <td><p>Champ obligatoire</p></td>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <td><label for="nom">Nom</label></td>
                    <td><input id="nom" type="text" name="nom"  value="<?php if (isset($_POST["nom"])) { echo $_POST["nom"]; } ?>" /></td>
                    <?php
                    if (isset($_POST["rempli"]) && !isset($_POST["nom"])) {
                        ?>
                        <td><p>Champ obligatoire</p></td>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom</label></td>
                    <td><input id="prenom" type="text" name="prenom"  value="<?php if (isset($_POST["prenom"])) { echo $_POST["prenom"]; } ?>" /></td>
                    <?php
                    if (isset($_POST["rempli"]) && !isset($_POST["prenom"])) {
                        ?>
                        <td><p>Champ obligatoire</p></td>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <td><label for="naissance">Date de naissance</label></td>
                    <td><input id="naissance" type="date" name="naissance"  value="<?php if (isset($_POST["pseudo"])) { echo $_POST["naissance"]; } ?>" /></td>
                    <?php
                    if (isset($_POST["rempli"]) && !isset($_POST["naissance"])) {
                        ?>
                        <td><p>Champ obligatoire</p></td>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <td><label for="poste">Poste</label></td>
                    <td><input id="poste" type="text" name="poste"  value="<?php if (isset($_POST["poste"])) { echo $_POST["poste"]; } ?>" /></td>
                    <?php
                    if (isset($_POST["rempli"]) && !isset($_POST["poste"])) {
                        ?>
                        <td><p>Champ obligatoire</p></td>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <td><label for="secteur">Secteur</label></td>
                    <td><input id="secteur" type="text" name="secteur"  value="<?php if (isset($_POST["secteur"])) { echo $_POST["secteur"]; } ?>" /></td>
                    <?php
                    if (isset($_POST["rempli"]) && !isset($_POST["secteur"])) {
                        ?>
                        <td><p>Champ obligatoire</p></td>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Inscription" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>
