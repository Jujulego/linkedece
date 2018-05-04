<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 02/05/2018
 * Time: 13:47
 */?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="css/style_profil.css" />
    <link rel="stylesheet" href="css/style_menuhaut.css" />
    <link rel="stylesheet" href="css/style_general.css" />
    <title>Profil</title>
</head>

<body>
    <?php include("include/menuhaut.php") ?>

    <div id="conteneur">
        <section id="profil">

            <p>Tel</p>
            <p>Email</p>
            <p>50 relations</p>
        </section>

        <div class="moi">

                    <div class="couverture"><img src="images/couverture.png" width="980" height="100" alt="Photo de couverture par défault" /></div>
                    <div class="photoprof"><img src="images/profil.png" width="100px" height="100px" alt="Photo de profil par défault" /></div>
                    <div class="infos">Nom Prenom</div>
                    <div class="infos">Titre</div>
                    <div class="infos">Emploi actuel</div>
                    <div class="infos">Pays et ville</div>
                    <div class="photos"> <a href="photos.php">Photos</a></div>
                    <div class="modifmoi"> <a href="modifierprofil.php">Modifier</a></div>


        </div>
        <div class="parcours">
            <h2>Mon experience</h2>
            <div class="table-responsive">
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
                        <td><input type="date" value="datedebut""/></td>
                        <td><input type="date" value="datefin""/></td>
                        <td><input type="text" value="poste"/></td>
                        <td><input type="text" value="Entreprise"/></td>
                        <td><button type="button" OnClick="window.location.href=modifexperience.php"class="btn btn-default">Ajouter</button></td>
                    </tr>
                </tbody>
            </table>
            </div>

            <h2>Ma formation</h2>

            <div class="table-responsive">
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
                            <td><input type="date" value="datedebut""/></td>
                            <td><input type="date" value="datefin"/></td>
                            <td><input type="text" placeholder="annee"/></td>
                            <td><input type="text" placeholder="ecole"/></td>
                            <td><input type="text" placeholder="Competences acquises"/></td>
                            <td><button type="button" OnClick="window.location.href=modifexperience.php"class="btn btn-default">Ajouter</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
