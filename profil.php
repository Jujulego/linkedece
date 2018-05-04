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

function texteAleatoire($longueur) {
    $texte = "";

    for ($i = 0; $i < $longueur; ++$i) {
        $texte .= dechex(mt_rand(0, 15));
    }

    return $texte;
}

// Récupération des infos utilisateur
$bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");
$req = $bdd->prepare("select type,email,nom,prenom from utilisateur where pseudo = ?");
$req->execute(array($_SESSION["pseudo"]));
$infos = $req->fetch();
$req->closeCursor();

// nombre de relations
$req = $bdd->prepare("select count(*) as nbrel from relation where utilisateur1 = :pseudo xor utilisateur2 = :pseudo");
$req->execute([":pseudo" => $_SESSION["pseudo"]]);
$nbrel = $req->fetch()['nbrel'];
$req->closeCursor();

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
        <div class="moi">
            <div class="couverture"><img src="images/couverture.png" width="980" height="100" alt="Photo de couverture par défault" /></div>
            <div class="photoprof"><img src="images/profil.png" width="100px" height="100px" alt="Photo de profil par défault" /></div>
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
            <div class="infos"><?php echo htmlspecialchars($infos['email']) ?></div>
            <div class="modifmoi"><a href="modifierprofil.php">Modifier</a></div>

        </div>
        <div class="parcours">
            <h2>Mon experience</h2>
            <div class="modifparcours"><a href="modifexperience.php"><button type="button" class="btn btn-default">Modifier</button></a></div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Poste</th>
                        <th>Entreprise</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>juillet-aout 2017</td>
                        <td>Maitre nageur</td>
                        <td>Piscine municipale</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <h2>Ma formation</h2>
            <div class="modifparcours"><button type="button" OnClick="window.location.href=modifexperience.php"class="btn btn-default">Modifier</button></div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Année</th>
                        <th>Ecole</th>
                        <th>Compétences acquises</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Septembre-Decembre 2017</td>
                        <td>3ème année- semestre à l'étranger</td>
                        <td>Bangor University</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <h2>Mes publications</h2>
            <?php
            $posts = $bdd->prepare(
                "select id,date,auteur,message,multimedia,nom,prenom
                        from post
                          inner join publication on post.id=publication.post
                          inner join utilisateur on post.auteur = utilisateur.pseudo 
                        where auteur = :pseudo
                        order by date desc"
            );
            $posts->execute([":pseudo" => $_SESSION["pseudo"]]);
            include("include/posts.php");
            $posts->closeCursor();
            ?>
        </div>
    </div>
</body>
</html>
