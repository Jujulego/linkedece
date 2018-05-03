<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 03/05/2018
 * Time: 10:37
 */
session_start();

if (isset($_SESSION["pseudo"])) {
    // Si connecté redirection vers accueil.php
    header("Location: accueil.php", true, 303);
} else {
    // Sinon redirection vers connexion.php
    header("Location: connexion.php", true, 303);
}
exit();
?>