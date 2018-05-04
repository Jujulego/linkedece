<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 04/05/2018
 * Time: 15:08
 */

?>
<section id="profil">
    <img src="images/profil.png" width="100px" height="100px" alt="Photo de profil par défault" />
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
</section>