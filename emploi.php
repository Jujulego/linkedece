<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 04/05/2018
 * Time: 09:32
 */
session_start();

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="css/style_profil.css" />
        <link rel="stylesheet" href="css/style_menuhaut.css" />
        <link rel="stylesheet" href="css/style_general.css" />
        <link rel="stylesheet" href="css/style_emplois.css" />

        <title>Modifier votre experience</title>
    </head>
    <body>
        <?php include("include/menuhaut.php") ?>

        <div id="conteneur">
            <?php include("include/panneauprofil.php"); ?>

            <div>
                <h1>Offres d'emplois disponibles</h1>
                <section id="murreseau" class="notifmur">
                    <article>
                        <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification" />

                        <div class="poste"> <label>Poste:   </label></div>
                        <div class="entreprise"> <label>Entreprise: </label></div>
                        <div class="secteur"><label>Secteur:</label></div>
                        <button type="button" class="btn btn-primary">Postuler</button>
                    </article>
                    <article>
                        <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification" />

                        <div class="poste"> <label>Poste:   </label></div>
                        <div class="entreprise"> <label>Entreprise: </label></div>
                        <div class="secteur"><label>Secteur:</label></div>
                        <button type="button" class="btn btn-primary">Postuler</button>
                    </article>
                    <article>
                        <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification" />

                        <div class="poste"> <label>Poste:   </label></div>
                        <div class="entreprise"> <label>Entreprise: </label></div>
                        <div class="secteur"><label>Secteur:</label></div>
                        <button type="button" class="btn btn-primary">Postuler</button>
                    </article>
                    <article>
                        <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification" />

                        <div class="poste"> <label>Poste:   </label></div>
                        <div class="entreprise"> <label>Entreprise: </label></div>
                        <div class="secteur"><label>Secteur:</label></div>
                        <button type="button" class="btn btn-primary">Postuler</button>
                    </article>
                    <article>
                        <img src="images/notif.png" width="60px" height="60px" alt="Photo de notification" />

                        <div class="poste"> <label>Poste:   </label></div>
                        <div class="entreprise"> <label>Entreprise: </label></div>
                        <div class="secteur"><label>Secteur:</label></div>
                        <button type="button" class="btn btn-primary">Postuler</button>
                    </article>
                </section>
            </div>
        </div>
    </body>
</html>

