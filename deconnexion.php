<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 03/05/2018
 * Time: 10:39
 */
session_start();

// Déconnexion
if (isset($_SESSION["pseudo"])) {
    session_destroy();
}

// Redirection vers connexion.php
header("Location: connexion.php", true, 303);
exit();

?>