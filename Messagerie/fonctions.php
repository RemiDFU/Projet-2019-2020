<?php


	function connecterBDD(){
		$server="localhost";
		$login="root";
		$mdp="";
		$db="projetjs";
		// se connecter
		try {
			$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
		}
		catch (Exception $e) { 
			die('Erreur : '. $e->getMessage()); 
		}
		return $linkpdo;
    }
	
	/*function recuperer10derniers() {
        $conn = connecterBDD();

        $stmt = $conn->prepare("SELECT * FROM chat ORDER BY horaire DESC LIMIT 10");
        $stmt->execute();

        /*while( $result = $stmt->fetch()) {
            echo('<p class="message">'.$result['auteur'].' : '.$result['contenu'].'</p>');
        }*/
	
		/*$result = $stmt->fetch();
		return $result;
	}*/

	/*function dateDiff($date1, $date2){
        $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
        $retour = array();
     
        $tmp = $diff;
        $retour['second'] = $tmp % 60;
     
        $tmp = floor( ($tmp - $retour['second']) /60 ); //floor : arrondit a l'entier inférieur
        $retour['minute'] = $tmp % 60;
     
        $tmp = floor( ($tmp - $retour['minute'])/60 );
        $retour['hour'] = $tmp % 24;
     
        $tmp = floor( ($tmp - $retour['hour'])  /24 );
        $retour['day'] = $tmp;
     
        return $retour;
    }*/
?>
<?php
	function enregistrerMessage(){
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
	}
?>