<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 04/05/2018
 * Time: 15:21
 */

while ($post = $posts->fetch()) {
    // Check partagé
    $reqp = $bdd->prepare("select jaime from partage where utilisateur = ? and publication = ?");
    $reqp->execute(array(
        $_SESSION["pseudo"],
        $post["id"]
    ));

    $partagee = $reqp->rowCount() != 0;
    $aimee = $partagee ? $reqp->fetch()["jaime"] : false;

    $reqp->closeCursor();
    ?>
    <article id="<?php echo $post["id"]; ?>" class="publication">
        <div class="postprofil">
            <img src="<?php echo ($post["photoprofil"] == null ? "images/profil.png" : "media/" . $post["photoprofil"]) ?>" width="60px" height="60px"
                 alt="Photo de profil par défault"/>
            <p>
                <a href="profil.php?<?php echo http_build_query(["pseudo"=>$post["auteur"]]) ?>">
                    <?php echo htmlspecialchars($post['prenom'] . ' ' . $post['nom']) ?>
                </a>
            </p>
            <p>
                <?php echo htmlspecialchars($post['poste']) ?></p>
            <div>
                <?php if ($aimee) {
                    ?>
                    <img src="images/aimebleu.png" width="30px" height="30px" alt="pouce j'aime">
                    <?php
                } else if ($partagee) {
                    ?>
                    <img src="images/aime.png" width="30px" height="30px" alt="pouce j'aime">
                    <?php
                } else {
                    ?>
                    <a href="partage.php?<?php echo http_build_query([
                        "post" => $post["id"],
                        "like" => 1
                    ]); ?>">
                        <img src="images/aime.png" width="30px" height="30px" alt="pouce j'aime">
                    </a>
                    <?php
                }
                ?>

                <a href="http://ton lien">
                    <img src="images/commentaire.png" width="30px" height="30px" alt="commentaire">
                </a>

                <?php if ($partagee) {
                    ?>
                    <img src="images/partagebleu.png" width="30px" height="30px" alt="commentaire">
                    <?php
                } else {
                    ?>
                    <a href="partage.php?<?php echo http_build_query([
                        "post" => $post["id"]
                    ]); ?>">
                        <img src="images/partage.png" width="30px" height="30px" alt="commentaire">
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
        <hr />
        <div class="post">
            <?php
            if ($post["multimedia"] != null) {
                // Récupération des infos image
                $reqm = $bdd->prepare("select fichier,type from multimedia where id = ?");
                $reqm->execute(array($post["multimedia"]));

                $image = $reqm->fetch();

                $reqm->closeCursor();

                if ($image["type"] == "img") {
                    ?>
                    <img src="<?php echo "media/" . $image["fichier"]; ?>"/>
                    <?php
                } else {
                    ?>
                    <video controls src="<?php echo "media/" . $image["fichier"]; ?>"></video>
                    <?php
                }
            }
            ?>
            <p><?php echo htmlspecialchars($post['message']) ?></p>
        </div>
    </article>
    <?php
}
?>