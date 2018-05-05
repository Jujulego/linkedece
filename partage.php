<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 04/05/2018
 * Time: 10:03
 */
session_start();
include("include/notifications.php");

// connecté ?
if (!isset($_SESSION["pseudo"])) {
    header("Location: connexion.php", true, 303);
    exit();
}

// Ajout du partage à la base de données
$bdd = new PDO("mysql:host=localhost;dbname=linkedece;charset=utf8", "root", "");
if (isset($_GET["like"])) {
    $req = $bdd->prepare("insert into partage values (null, ?, ?, true)");
} else {
    $req = $bdd->prepare("insert into partage values (null, ?, ?, false)");
}

$req->execute(array(
    $_SESSION["pseudo"],
    $_GET["post"]
));
$req->closeCursor();

// notification
$req = $bdd->prepare("select auteur from post where id = ?");
$req->execute(array($_GET["post"]));
$post = $req->fetch();
$req->closeCursor();

if (isset($_GET["like"])) {
    notif_like($bdd, $_SESSION["pseudo"], $post["auteur"], $_GET["post"]);
} else {
    notif_partage($bdd, $_SESSION["pseudo"], $post["auteur"], $_GET["post"]);
}

// Retour vers l'accueil
header("Location: accueil.php#". $_GET["post"], true, 303);
exit();

?>