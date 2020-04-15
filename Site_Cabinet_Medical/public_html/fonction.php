<?php

	function estConnecte($sessionLogin , $sessionPassword){
		$connect=false;
		if($sessionLogin=='iutinfo' && $sessionPassword=='$iutinfo'){
			$connect=true;
		}else{
			echo 'Vous devez être connecter pour accéder à cette page';
			echo '<form action="index.html" >';
			echo '<input type="submit" value="Se connecter" name="Bouton" >';
			echo '</form>';
			
		}
		return $connect;
	}

	function seConnecter($postLogin , $postPassword){
		$connect=false;
		if($postLogin=='iutinfo' && $postPassword=='$iutinfo'){
				session_start ();
				$_SESSION['login']=$postLogin;
				$_SESSION['password']=$postPassword;
				$connect=true;
		}
		return $connect;
	}

	function connecterBDD(){
		$server="localhost";
		$login="brs3114a";
		$mdp="Ggt536AC";
		$db="brs3114a";
		// se connecter
		try {
			$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
		}
		catch (Exception $e) { 
			die('Erreur : '. $e->getMessage()); 
		}
		return $linkpdo;
	}

	function chevauchement($id_medecin, $date_c, $heure_c, $duree_c){
		$linkpdo=connecterBDD();
		$req = $linkpdo->prepare("select count(*) as NB from Consultation 
															where date_c = :date_c
															and id_medecin = :id_medecin
															and (time_to_sec(:heure_c) between time_to_sec(heure_c) and time_to_sec(heure_c) + duree_c*60
															OR (time_to_sec(:heure_c)+:duree_c*60) between time_to_sec(heure_c) and time_to_sec(heure_c)+duree_c*60
															OR (time_to_sec(:heure_c) <= time_to_sec(heure_c) and (time_to_sec(:heure_c)+:duree_c*60) >= (time_to_sec(heure_c)+duree_c*60))) ");



		$req->execute(array('id_medecin' => $id_medecin, 'date_c' => $date_c,'heure_c' => $heure_c, 'duree_c' => $duree_c));
		while ($data = $req->fetch()) { 
	    $nb_chevauchement=$data['NB'];
		}
		$req->closeCursor();
		return $nb_chevauchement!=0 ;
		
	}
	
?> 
