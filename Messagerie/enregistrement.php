<?php
    include('fonctions.php');
    $linkpdo = connecterBDD();

    if(isset($_GET['zoneEcriture'])) {
        echo("Get ok\n");
        echo($_GET['zoneEcriture']);
    } else {
        echo("Get pas ok");
    }

    $req = $linkpdo->prepare('INSERT INTO Chat (horaire, auteur, contenu) VALUES (current_timestamp(), :auteur, :contenu) ');
    $req->bindValue('contenu', $_GET['zoneEcriture']);
    $req->bindValue('auteur', $_GET['auteurForm']);
    $req->execute();

    echo "Message enregistré"; 

?>