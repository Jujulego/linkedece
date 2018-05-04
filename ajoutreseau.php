<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 04/05/2018
 * Time: 17:17
 */
session_start();

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="css/style_ajout_reseau.css" />
        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />

        <title>Réseau</title>
    </head>

    <body>
        <?php include("include/menuhaut.php") ?>
        <div id="conteneur">
            <?php include("include/panneauprofil.php") ?>
            <section id="murreseau">
                <article class="liencontact">
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <a href="#page de profil du contact">Prenom Nom</a>
                    <input type="button" value="Ajouter à mon réseau">
                </article>
                <article class="liencontact">
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <a href="#page de profil du contact">Prenom Nom</a>
                    <input type="button" value="Ajouter à mon réseau">
                </article>
                <article class="liencontact">
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <a href="#page de profil du contact">Prenom Nom</a>
                    <input type="button" value="Ajouter à mon réseau">
                </article><article class="liencontact">
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <a href="#page de profil du contact">Prenom Nom</a>
                    <input type="button" value="Ajouter à mon réseau">
                </article><article class="liencontact">
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <a href="#page de profil du contact">Prenom Nom</a>
                    <input type="button" value="Ajouter à mon réseau">
                </article><article class="liencontact">
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <a href="#page de profil du contact">Prenom Nom</a>
                    <input type="button" value="Ajouter à mon réseau">
                </article><article class="liencontact">
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <a href="#page de profil du contact">Prenom Nom</a>
                    <input type="button" value="Ajouter à mon réseau">
                </article><article class="liencontact">
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <a href="#page de profil du contact">Prenom Nom</a>
                    <input type="button" value="Ajouter à mon réseau">
                </article><article class="liencontact">
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <a href="#page de profil du contact">Prenom Nom</a>
                    <input type="button" value="Ajouter à mon réseau">
                </article><article class="liencontact">
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <a href="#page de profil du contact">Prenom Nom</a>
                    <input type="button" value="Ajouter à mon réseau">
                </article><article class="liencontact">
                    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
                    <a href="#page de profil du contact">Prenom Nom</a>
                    <input type="button" value="Ajouter à mon réseau">
                </article>
            </section>
        </div>
    </body>
</html>