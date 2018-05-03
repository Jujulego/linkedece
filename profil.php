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
                    <div class="modifmoi"> <a href="modifierprofil.php">Modifier</a></div>

        </div>


            <div class="parcours">
                <div class="panel-group">
                    <div class="panel panel-info">
                        <div class="panel-heading">Experience
                            <div class="modifparcours"><button type="button" class="btn btn-default">Modifier</button></div></div>
                        <div class = texte class="panel-body">blablabla</div>
                    </div>
                    <div class="panel panel-info">
                        <div class="panel-heading">Formation
                            <div class="modifparcours"><button type="button"  class="btn btn-default">Modifier</button></div></div>
                        <div class = texte class="panel-body">blablabla</div>
                    </div>
                </div>

        </div>


    </div>



</body>
</html>
