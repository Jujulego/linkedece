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
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'da', ?, ?, null)");
    $req->execute(array(
        $emetteur,
        $cible
    ));
    $req->closeCursor();
}

function accepter_ami($bdd, $notif, $emetteur, $cible) {
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'aa', ?, ?, null)");
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
        $reqa = $bdd->prepare("insert into notification values (null, current_timestamp, 'pu', ?, ?, ?)");
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
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'pa', ?, ?, ?)");
    $req->execute(array(
        $emetteur,
        $cible,
        $post
    ));
    $req->closeCursor();
}

function notif_like($bdd, $emetteur, $cible, $post) {
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'li', ?, ?, ?)");
    $req->execute(array(
        $emetteur,
        $cible,
        $post
    ));
    $req->closeCursor();
}

function notif_comment($bdd, $emetteur, $cible, $post) {
    $req = $bdd->prepare("insert into notification values (null, current_timestamp, 'co', ?, ?, ?)");
    $req->execute(array(
        $emetteur,
        $cible,
        $post
    ));
    $req->closeCursor();
}

?>