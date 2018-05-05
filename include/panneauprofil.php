<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 04/05/2018
 * Time: 15:08
 */

// Récupération des infos utilisateur
if (!isset($bdd)) {
    $bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");
}
$req = $bdd->prepare(
    "select utilisateur.type as type,pseudo,email,nom,prenom,fichier,poste,secteur
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

?>
<section id="profil">
    <img src="<?php echo ($infos["fichier"] == null ? "images/profil.png" : "media/" . $infos["fichier"]) ?>" width="100px" height="100px" alt="Photo de profil par défault" />
    <p><?php echo htmlspecialchars($infos['prenom'] . ' ' . $infos['nom']) ?></p>
    <p><?php
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
    ?></p>
    <p><?php echo htmlspecialchars($infos['email']) ?></p>
    <p><?php echo $nbrel . ' relation' . ($nbrel != 1 ? 's' : '') ?></p>
    <?php
        if ($infos["type"] == "adm") {
            ?>
                <ul>
                    <li><a href="reseauadmin.php">Gestion utilisateurs</a></li>
                </ul>
            <?php
        }
    ?>
</section>