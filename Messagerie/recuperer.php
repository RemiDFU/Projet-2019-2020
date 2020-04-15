<?php
    include("fonctions.php");
?>

<?php
    $conn = connecterBDD();

    $stmt = $conn->prepare("SELECT * FROM chat ORDER BY horaire DESC LIMIT 10");
    $stmt->execute();
    
    while( $result = $stmt->fetch()) {
        echo('<p class="msg">'.$result['auteur'].' : '.$result['contenu'].'</p><p class="horaire">'.$result['horaire'].'</p>');
        
        /*$now = time();
        echo("Heure actuelle : ".$now);
        $dateMessage = strtotime($result['horaire']);
        //print_r(dateDiff($now, $date1)); //Array ( [second] => 51 [minute] => 46 [hour] => 3 [day] => 0 )
        $retourDate = dateDiff($now, $dateMessage);
        echo("Il y a ".$retourDate['day']." jours, ".$retourDate['hour']." heures, ".$retourDate['minute']." minutes, ".$retourDate['second']." secondes.");*/
    }
?>