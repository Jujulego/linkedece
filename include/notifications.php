<?php
/**
 * Created by PhpStorm.
 * User: julie
 * Date: 05/05/2018
 * Time: 15:54
 */

// Fonctions utiles
function suppr_notif($bdd, $notif) {
    $req = $bdd->prepare("delete from notification where id = ?");
    $req->execute(array(
        $notif
    ));
    $req->closeCursor();
}

function demande_ami($bdd, $emetteur, $cible) {
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'da', ?, ?, null, null)");
    $req->execute(array(
        $emetteur,
        $cible
    ));
    $req->closeCursor();
}

function accepter_ami($bdd, $notif, $emetteur, $cible) {
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'aa', ?, ?, null, null)");
    $req->execute(array(
        $emetteur,
        $cible
    ));
    $req->closeCursor();

    $req = $bdd->prepare("insert into relation values (null, ?, ?)");
    $req->execute(array(
        $emetteur,
        $cible
    ));
    $req->closeCursor();

    suppr_notif($bdd, $notif);
}

function notif_publier($bdd, $emetteur, $post) {
    $req = $bdd->prepare(
        "select utilisateur2 as pseudo from relation where utilisateur1 = :pseudo
   union select utilisateur1 as pseudo from relation where utilisateur2 = :pseudo"
    );
    $req->execute([
        "pseudo" => $emetteur
    ]);

    while ($ami = $req->fetch()) {
        $reqa = $bdd->prepare("insert into notification values (null, current_timestamp, 'pu', ?, ?, ?, null)");
        $reqa->execute(array(
            $emetteur,
            $ami["pseudo"],
            $post
        ));
        $reqa->closeCursor();
    }

    $req->closeCursor();
}

function notif_partage($bdd, $emetteur, $cible, $post) {
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'pa', ?, ?, ?, null)");
    $req->execute(array(
        $emetteur,
        $cible,
        $post
    ));
    $req->closeCursor();
}

function notif_like($bdd, $emetteur, $cible, $post) {
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'li', ?, ?, ?, null)");
    $req->execute(array(
        $emetteur,
        $cible,
        $post
    ));
    $req->closeCursor();
}

function notif_comment($bdd, $emetteur, $cible, $post) {
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'co', ?, ?, ?, null)");
    $req->execute(array(
        $emetteur,
        $cible,
        $post
    ));
    $req->closeCursor();
}

function notif_postuler($bdd, $emetteur, $cible, $offre) {
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'po', ?, ?, null, ?)");
    $req->execute(array(
        $emetteur,
        $cible,
        $offre
    ));
    $req->closeCursor();
}

function notif_accepter($bdd, $emetteur, $cible, $offre) {
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'ap', ?, ?, null, ?)");
    $req->execute(array(
        $emetteur,
        $cible,
        $offre
    ));
    $req->closeCursor();

    // On refuse toutes les autres postulations
    $req = $bdd->prepare("select postulant from postulation where offre = ? and postulant != ?");
    $req->execute(array(
        $offre,
        $cible
    ));

    while ($p = $req->fetch()) {
        notif_refuser($bdd, $emetteur, $p["postulant"], $offre);
    }

    $req->closeCursor();

    // On marque la postulation comme acceptée
    $req = $bdd->prepare("update offre set acceptee=true where id = ?");
    $req->execute(array(
        $offre
    ));
    $req->closeCursor();

    // on supprime la notification
    $req = $bdd->prepare("delete from notification where offre = ? and emetteur = ? and cible = ? and type='po'");
    $req->execute(array(
        $offre,
        $cible,
        $emetteur
    ));
    $req->closeCursor();
}

function notif_refuser($bdd, $emetteur, $cible, $offre) {
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'rp', ?, ?, null, ?)");
    $req->execute(array(
        $emetteur,
        $cible,
        $offre
    ));
    $req->closeCursor();

    // on supprime la postulation
    $req = $bdd->prepare("delete from postulation where offre = ? and postulant = ?");
    $req->execute(array(
        $offre,
        $cible
    ));
    $req->closeCursor();

    // on supprime la notification
    $req = $bdd->prepare("delete from notification where offre = ? and emetteur = ? and cible = ? and type='po'");
    $req->execute(array(
        $offre,
        $cible,
        $emetteur
    ));
    $req->closeCursor();
}

?>