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
    <img src="images/profil.png" width="60px" height="60px" alt="Photo de profil par défaut" href=""/>

    <form enctype="multipart/form-data" method="post">
        <br>



        <input type="file" accept="image/*" name="imgfile" /><br>
        <input type="submit" value="Valider"/>
        <br>
        <br>

        <table>
            <tr>
                <td><label for="prenom">Prénom :</label></td>
                <td><input id="prenom" type="text" name="prenom"/></td>
                <td><label for="nom">Nom :</label></td>
                <td><input id="nom" type="text" name="nom"/></td>
            </tr>
            <tr>
                <td><label for="titre">Titre :</label></td>
                <td><input id="titre" type="text" name="titre"/></td>
                <td><label for="poste">Poste actuel :</label></td>
                <td><input id="poste" type="text" name="poste"/></td>
            </tr>
            <tr>
                <td><label for="pays">Pays :</label></td>
                <td><input id="pays" type="text" name="pays"/></td>
                <td><label for="ville">Ville :</label></td>
                <td><input id="ville" type="text" name="ville"/></td>
            </tr>
            <tr>
                <td><label for="secteur">Secteur :</label></td>
                <td><input id="secteur" type="text" name="secteur"/></td>
            </tr>
            <tr>
                <td><label for="resume">Résumé :</label></td>
                <td><label>
                        <textarea  style="width: 300px;height:100px" placeholder="Résumé..."></textarea>
                    </label></td>
            </tr>
            <tr>
                <td>

                </td>
                <td></td>
                <td></td>
                <td><input type="submit" value="Enregistrer les modifications" ></td>
            </tr>


        </table>
    </form>
</div>




</body>
</html>
