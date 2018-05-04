<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn
 * Date: 04/05/2018
 * Time: 09:15
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

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="css/style_profil.css" />
    <link rel="stylesheet" href="css/style_menuhaut.css" />
    <link rel="stylesheet" href="css/style_general.css" />
    <link rel="stylesheet" href="css/style_modifformation.css" />

    <title>Modifier votre experience</title>
</head>
<body>
<?php include("include/menuhaut.php") ?>
<h1>Modifier votre experience</h1>


</body>
</html>
