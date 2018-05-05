<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 02/05/2018
 * Time: 12:45
 */
session_start();

$mauvais_pseudo = false;
$mauvais_motdepasse = false;

if (isset($_POST['pseudo'], $_POST['mot_de_passe'])) {
    // Tentative de connexion
    $bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");

    // Requete de test
    $req = $bdd->prepare("select mot_de_passe from utilisateur where pseudo = ?");
    $req->execute(array($_POST['pseudo']));

    if ($req->rowCount() == 0) {
        // Pas de résultat
        $mauvais_pseudo = true;
    } else {
        // Check mot de passe
        $mot_de_passe_bdd = $req->fetch()['mot_de_passe'];

        if (password_verify($_POST["mot_de_passe"], $mot_de_passe_bdd)) {
            // Connecté !!!
            $_SESSION['pseudo'] = $_POST['pseudo'];
            header("Location: accueil.php", true, 303);
            exit();

        } else {
            $mauvais_motdepasse = true;
        }
    }

    $req->closeCursor();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_connexion.css" />

        <title>Connexion</title>
    </head>
    <body>
        <section>
            <h1>Bienvenue</h1>

            <div id="formulaires">
                <article>
                    <h2>Connexion</h2>

                    <?php
                        if ($mauvais_pseudo) {
                    ?>
                            <p class="erreur">Mauvais pseudo</p>
                    <?php
                        } else if ($mauvais_motdepasse) {
                    ?>
                            <p class="erreur">Mauvais mot de passe</p>
                    <?php
                        }
                    ?>

                    <form method="post">
                        <input name="pseudo" type="text" placeholder="pseudo" value="<?php if (isset($_POST["pseudo"])) { echo $_POST["pseudo"]; } ?>"/>
                        <input name="mot_de_passe" type="password" placeholder="mot de passe" />

                        <input type="submit" value="Connexion !">
                    </form>
                </article>

                <article>
                    <h2>Inscription</h2>

                    <form method="post" action="inscription.php">
                        <p>
                            <label for="categorie">Vous êtes un </label>
                            <select id="categorie" name="categorie">
                                <option value="etu">étudiant</option>
                                <option value="pro">professeur</option>
                                <option value="par">partenaire</option>
                            </select>
                        </p>

                        <input type="submit" value="Inscription">
                    </form>
                </article>
            </div>
        </section>
    </body>
</html>
