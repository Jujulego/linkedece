<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 02/05/2018
 * Time: 13:47
 */
session_start();

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

// Connexion à la base de données
$bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");

// Admin ?
$req = $bdd->prepare("select type from utilisateur where pseudo = ?");
$req->execute(array($_SESSION["pseudo"]));
$admin = $req->fetch()["type"] == "adm";
$req->closeCursor();

// Envoi de formulaire
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST["form"] == "stage") {
        // Ajout d'expérience
        if (isset($_POST["date_debut"], $_POST["date_fin"], $_POST["poste"], $_POST["societe"])) {
            $req = $bdd->prepare("insert into stage values (null, ?, ?, ?, ?, ?)");
            $req->execute(array(
                $_POST["societe"],
                $_POST["poste"],
                $_POST["date_debut"],
                $_POST["date_fin"],
                $_GET["pseudo"]
            ));
        } else {
            $serreur = "Tous les champs sont obligatoires";
        }
    } else if ($_POST["form"] == "formation") {
        // Ajout de formation
        if (isset($_POST["date_debut"], $_POST["date_fin"], $_POST["ecole"], $_POST["competence"])) {
            $req = $bdd->prepare("insert into formation values (null, ?, ?, ?, ?, ?)");
            $req->execute(array(
                $_POST["ecole"],
                $_POST["competence"],
                $_POST["date_debut"],
                $_POST["date_fin"],
                $_GET["pseudo"]
            ));
        } else {
            $ferreur = "Tous les champs sont obligatoires";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">


        <link rel="stylesheet" href="css/style_profil.css" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />
        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_posts.css" />

        <title>Profil</title>
    </head>
    <body>
        <?php include("include/menuhaut.php") ?>

        <div id="conteneur">
            <?php include("include/panneauprofil.php"); ?>
            <?php
                if (isset($_GET["pseudo"])) {
                    $req = $bdd->prepare(
                        "select pseudo,utilisateur.type as type,email,nom,prenom,fichier,poste,secteur
                                      from utilisateur left join multimedia on utilisateur.photo_profil = multimedia.id
                                      where pseudo = ?"
                    );
                    $req->execute(array($_GET["pseudo"]));
                    $infos = $req->fetch();
                    $req->closeCursor();
                }
            ?>
            <div class="moi">
                <div class="couverture"><img src="images/couverture.png" width="980" height="100" alt="Photo de couverture par défault" /></div>
                <div class="photoprof"><img src="<?php echo ($infos["fichier"] == null ? "images/profil.png" : "media/" . $infos["fichier"]) ?>" width="100px" height="100px" alt="Photo de profil par défault" /></div>
                <div class="infos"><?php echo htmlspecialchars($infos['prenom'] . ' ' . $infos['nom']) ?></div>
                <div class="infos"><?php
                    switch ($infos['type']) {
                        case 'adm':
                            echo "Administrateur";
                            break;

                        case 'etu':
                            echo "Etudiant";
                            break;

                        case 'pro':
                            echo "Professeur";
                            break;

                        case 'par':
                            echo "Partenaire";
                            break;

                        default:
                            echo "Hacker ;)";
                    }
                    ?></div>
                <div class="infos"><?php echo htmlspecialchars($infos['poste'] . " " . $infos["secteur"]) ?></div>
                <div class="infos"><?php echo htmlspecialchars($infos['email']) ?></div>
                <?php
                    if ($admin || $infos["pseudo"] == $_SESSION["pseudo"]) {
                        ?>
                        <div class="modifmoi"><a href="modifierprofil.php?<?php echo http_build_query(["pseudo" => $infos["pseudo"]]); ?>">Modifier</a></div>
                        <?php
                    }
                ?>

            </div>
            <div class="parcours">
                <h2>Ma formation</h2>
                <form method="post" class="table-responsive">
                    <input type="hidden" name="form" value="formation" />
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date de debut</th>
                                <th>Date de fin</th>
                                <th>Ecole</th>
                                <th>Compétences acquises</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $req = $bdd->prepare(
                            "select date_debut,date_fin,ecole,competence
                                                from formation
                                                where utilisateur = ?
                                                order by date_debut"
                        );
                        $req->execute(array($infos["pseudo"]));

                        while ($formation = $req->fetch()) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($formation["date_debut"]); ?></td>
                                <td><?php echo htmlspecialchars($formation["date_fin"]); ?></td>
                                <td><?php echo htmlspecialchars($formation["ecole"]); ?></td>
                                <td><?php echo htmlspecialchars($formation["competence"]); ?></td>
                            </tr>
                            <?php
                        }
                        $req->closeCursor();
                        ?>
                        <?php
                        if ($admin || $infos["pseudo"] == $_SESSION["pseudo"]) {
                            ?>
                            <?php
                            if (isset($ferreur)) {
                                ?>
                                <tr>
                                    <td colspan="5"><?php echo $ferreur; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td>
                                    <input type="date" name="date_debut" placeholder="Date de début"
                                           value="<?php if (isset($ferreur, $_POST["date_debut"])) echo $_POST["date_debut"]; ?>"
                                    />
                                </td>
                                <td>
                                    <input type="date" name="date_fin" placeholder="Date de fin"
                                           value="<?php if (isset($ferreur, $_POST["date_fin"])) echo $_POST["date_fin"]; ?>"
                                    />
                                </td>
                                <td>
                                    <input type="text" name="ecole" placeholder="Ecole"
                                           value="<?php if (isset($ferreur, $_POST["ecole"])) echo $_POST["ecole"]; ?>"
                                    />
                                </td>
                                <td>
                                    <input type="text" name="competence" placeholder="Compétences"
                                           value="<?php if (isset($ferreur, $_POST["competence"])) echo $_POST["competence"]; ?>"
                                    />
                                </td>
                                <td>
                                    <input type="submit" class="btn btn-default" value="Ajouter"/>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </form>

                <h2>Mon experience</h2>
                <form method="post" class="table-responsive">
                    <input type="hidden" name="form" value="stage" />
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date de debut</th>
                                <th>Date de fin</th>
                                <th>Poste</th>
                                <th>Entreprise</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $req = $bdd->prepare(
                                    "select date_debut,date_fin,poste,societe
                                                from stage
                                                where utilisateur = ?
                                                order by date_debut"
                                );
                                $req->execute(array($infos["pseudo"]));

                                while ($stage = $req->fetch()) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($stage["date_debut"]); ?></td>
                                        <td><?php echo htmlspecialchars($stage["date_fin"]); ?></td>
                                        <td><?php echo htmlspecialchars($stage["poste"]); ?></td>
                                        <td><?php echo htmlspecialchars($stage["societe"]); ?></td>
                                    </tr>
                                    <?php
                                }
                                $req->closeCursor();
                            ?>
                            <?php
                                if ($admin || $infos["pseudo"] == $_SESSION["pseudo"]) {
                                    ?>
                                    <?php
                                    if (isset($serreur)) {
                                        ?>
                                        <tr>
                                            <td colspan="5"><?php echo $serreur; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="date" name="date_debut" placeholder="Date de début"
                                                value="<?php if (isset($serreur, $_POST["date_debut"])) echo $_POST["date_debut"]; ?>"
                                            />
                                        </td>
                                        <td>
                                            <input type="date" name="date_fin" placeholder="Date de fin"
                                                   value="<?php if (isset($serreur, $_POST["date_fin"])) echo $_POST["date_fin"]; ?>"
                                            />
                                        </td>
                                        <td>
                                            <input type="text" name="poste" placeholder="Poste"
                                                   value="<?php if (isset($serreur, $_POST["poste"])) echo $_POST["poste"]; ?>"
                                            />
                                        </td>
                                        <td>
                                            <input type="text" name="societe" placeholder="Entreprise"
                                                   value="<?php if (isset($serreur, $_POST["societe"])) echo $_POST["societe"]; ?>"
                                            />
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-default" value="Ajouter"/>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </form>

                <div id="liencv">
                    <p><a href="#mon_cv.pdf">Télécharger mon CV</a> </p><br>
                    <p>Mettre à jour mon cv : <input type="file" accept="application/pdf" name="cv" /></p>


                </div>

                <h2>Mes publications</h2>
                <?php
                $posts = $bdd->prepare(
                    "select post.id as id,date,auteur,message,multimedia,nom,prenom,fichier as photoprofil,poste
                                from post
                                  inner join publication on post.id=publication.post
                                  inner join utilisateur on post.auteur = utilisateur.pseudo 
                                  left join multimedia on utilisateur.photo_profil = multimedia.id
                                where auteur = :pseudo
                                order by date desc"
                );
                $posts->execute([":pseudo" => $infos["pseudo"]]);
                include("include/posts.php");
                $posts->closeCursor();
                ?>
            </div>
        </div>
    </body>
</html>
