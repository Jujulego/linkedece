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
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="css/style_accueil.css" />
        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />

        <title>Accueil</title>
    </head>

    <body>
        <?php include("include/menuhaut.php") ?>

        <div id="conteneur">
            <section id="profil">
                <img src="images/profil.png" width="100px" height="100px" alt="Photo de profil par défault" />
                <p><?php echo htmlspecialchars($infos['prenom'] . ' ' . $infos['nom']) ?></p>
                <p><?php switch ($infos['type']) {
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
                    }?></p>
                <p><?php echo htmlspecialchars($infos['email']) ?></p>
                <p><?php echo $nbrel . ' relation' . ($nbrel != 1 ? 's' : '') ?></p>
            </section>
            <section id="mur">
                <article id="status">
                    <div class="postprofil">
                        <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                        <p><?php echo htmlspecialchars($infos['prenom'] . ' ' . $infos['nom']) ?></p>
                    </div>
                    <hr>


                    <form>
                        <textarea placeholder="Votre statut..."></textarea>

                        <div id="statusinfos"
                            <div>
                                <label for="lieu"><img src="images/logolieu.png" width="30px" height="30px" /></label>
                                <input id="lieu" name="lieu" type="text" placeholder="Ecrivez votre lieu">
                            </div>
                            <div>
                                <a href="http://ton lien"><img src="images/ajoutimage.png" width="40px" height="38px" alt= "ajout images " data-toggle="tooltip" title="Insérer une image"></a>
                                <a href="http://ton lien"><img src="images/ajoutvideo.png" width="35px" height="38px" alt= "ajout vidéos" data-toggle="tooltip" title="Insérer une vidéo"></a>
                            </div>
                            <div>
                                <select name="confidentialité" size="1">
                                    <option>Public</option>
                                    <option>Relation</option>
                                </select>
                                <button type="submit" class="btn btn-primary" <input type="submit" float="right" width="10px" height="10px" value="Publier" >Publier</button>

                            </div>
                        </div>
      </form>
                </article>

                <?php
                    $req = $bdd->prepare(
                        "select date,auteur,message,multimedia,nom,prenom
                                    from post
                                      inner join publication on post.id=publication.post
                                      inner join utilisateur on post.auteur = utilisateur.pseudo 
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
                    $req->execute([":pseudo" => $_SESSION["pseudo"]]);

                    while ($post = $req->fetch()) {
                ?>
                        <article>
                            <div class="postprofil">
                                <img src="images/profil.png" width="60px" height="60px"
                                     alt="Photo de profil par défault"/>
                                <p><?php echo htmlspecialchars($post['prenom'] . ' ' . $post['nom']) ?></p>
                                <p>Poste actuel</p>
                                <div>
                                    <a href="http://ton lien"><img src="images/pouce j'aime.png" width="30px" height="30px"
                                                                   alt="pouce j'aime"></a>
                                    <a href="http://ton lien"><img src="images/commentaire.png" width="30px" height="30px"
                                                                   alt="commentaire"></a>
                                    <a href="http://ton lien"><img src="images/partagebleu.png" width="30px" height="30px"
                                                                   alt="commentaire"></a>
                                </div>
                            </div>
                            <hr />
                            <div class="post">
                                <p><?php echo htmlspecialchars($post['message']) ?></p>
                            </div>
                        </article>
                <?php
                    }

                    $req->closeCursor();
                ?>
            </section>
        </div>
    </body>
</html>