<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 03/05/2018
 * Time: 14:57
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style_accueil.css" />
    <link rel="stylesheet" href="css/style_general.css" />
    <link rel="stylesheet" href="css/style_menuhaut.css" />
    <link rel="stylesheet" href="css/style_photos.css" />
    <link rel="stylesheet" href="css/style_general.css" />

    <title>Mes photos</title>
</head>

<body>
    <?php include("include/menuhaut.php") ?>


    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="images/aime.png" width="100px" height="100px">
                <div class="carousel-caption">
                    <h3>titre de l'album</h3>
                    <p>lieu de la photo</p>
                </div>
            </div>

            <div class="item">
                <img src="images/partage.png"  width="100px" height="100px">
                <div class="carousel-caption">
                    <h3>titre de l'album</h3>
                    <p>lieu de la photo</p>
                </div>
            </div>

            <div class="item">
                <img src="images/partagebleu.png" width="100px" height="100px">
                <div class="carousel-caption">
                    <h3>titre de l'album</h3>
                    <p>lieu de la photo</p>
                </div>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</body>
</html>
