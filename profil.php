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
    <link rel="stylesheet" href="css/style_profil.css" />
    <link rel="stylesheet" href="css/style_menuhaut.css" />
    <link rel="stylesheet" href="css/style_general.css" />
    <title>Profil</title>
</head>

<body>
    <?php include("include/menuhaut.php") ?>

    <div id="conteneur">
        <section id="profil">
            <img src="images/profil.png" width="100px" height="100px" alt="Photo de profil par défault" />
            <p>Tel</p>
            <p>Email</p>
            <p>50 relations</p>
        </section>
        <article>
            <div id="post">
                <h2>Votre formation</h2>
                <textarea  style="width: 300px;height:100px" >Etudes :</textarea>
            </div>
        </article>

    </div>

</body>
</html>
