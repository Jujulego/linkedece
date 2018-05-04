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
                <div class="modifmoi"><a href="modifierprofil.php">Modifier</a></div>

            </div>
            <div class="parcours">
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
                            <tr>
                                <td>Septembre 2017</td>
                                <td>Decembre 2017</td>
                                <td>nageur</td>
                                <td>piscine municipale</td>
                            </tr>
                            <tr>
                                <td><input type="date" placeholder="date de début"/></td>
                                <td><input type="date" placeholder="date de fin"/></td>
                                <td><input type="text" placeholder="poste"/></td>
                                <td><input type="text" placeholder="Entreprise"/></td>
                                <td><input type="submit" class="btn btn-default" value="Ajouter" /></td>
                            </tr>
                        </tbody>
                    </table>
                </form>

                <h2>Ma formation</h2>

                <form method="post" class="table-responsive">
                    <input type="hidden" name="form" value="formation" />
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date de debut</th>
                                <th>Date de fin</th>
                                <th>Année</th>
                                <th>Ecole</th>
                                <th>Compétences acquises</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Septembre 2017</td>
                                <td>Decembre 2017</td>
                                <td>3ème année- semestre à l'étranger</td>
                                <td>Bangor University</td>
                                <td>elec et info</td>
                            </tr>
                            <tr>
                                <td><input type="date" placeholder="date de début"/></td>
                                <td><input type="date" placeholder="date de fin"/></td>
                                <td><input type="text" placeholder="annee"/></td>
                                <td><input type="text" placeholder="ecole"/></td>
                                <td><input type="text" placeholder="Competences acquises"/></td>
                                <td><input type="submit" class="btn btn-default" value="Ajouter" /></td>
                            </tr>
                        </tbody>
                    </table>
                </form>

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
