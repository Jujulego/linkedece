<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 03/05/2018
 * Time: 18:38
 */
?>

<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style_menuhaut.css" />
    <link rel="stylesheet" href="css/style_general.css" />

    <title>Modifier profil</title>
</head>
<body>
<?php include("include/menuhaut.php") ?>


<div id ="menugauche">
    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défault" />
</div>

<div>
    <form method="post">
        <table>
            <tr>
                <td><label for="Prénom">Prénom</label></td>
                <td><input id="prenom" type="text" name="prenom"/></td>
                <td><label for="nom">Nom</label></td>
                <td><input id="nom" type="text" name="nom"/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr><tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>


        </table>
    </form>
</div>




</body>
</html>
