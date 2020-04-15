<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>valider ajout consultation</title>
    </head>
    <body>
	
	<?php
		include('fonction.php');
		session_start();
		if(isset($_SESSION['login'])){
			$sessionLogin= $_SESSION['login'];
		}else{
			$sessionLogin="";
		}
		if(isset($_SESSION['password'])){
			$sessionPassword= $_SESSION['password'];
		}else{
			$sessionPassword="";
		}

		if(!estConnecte($sessionLogin,$sessionPassword)){
			exit;
		}
		
		$linkpdo = connecterBDD();
	?> 
	<ul>
	  <li><a href="Accueil_patient.php">Usagers</a></li>
	  <li><a href="Accueil_medecin.php">Médecins</a></li>
	  <li><a class="active" href="Accueil_consultation.php">Consultation</a></li>
	  <li><a href="Statistiques.php">Statistiques</a></li>
	</ul>
	<div id="connexion" >

	<?php	
		
	if(isset($_POST['date_c'])) {
		$date_c= $_POST['date_c'];	
		///echo $date_c;
	}
	if(isset($_POST['heure_c'])) {
		$heure_c= $_POST['heure_c'];
		//echo $heure_c;
	}
	if(isset($_POST['id_medecin'])) {
		$id_medecin= $_POST['id_medecin'];
		//echo $id_medecin;
	}
	if(isset($_POST['id_patient'])) {
		$id_patient= $_POST['id_patient'];
		//echo $id_patient;
	}
	if(isset($_POST['duree_c'])) {
		$duree_c= $_POST['duree_c'];
		//echo $duree_c;
	}
	if(chevauchement($id_medecin, $date_c, $heure_c, $duree_c)>0){
		echo "<p>Vous ne pouvez pas ajouter de consultation car il y a un chevauchement</p>";
		exit;
	
	}
	
	$req = $linkpdo->prepare("INSERT INTO Consultation(date_c, heure_c,duree_c , id_patient, id_medecin) VALUES(:date_c , :heure_c, :duree_c , :id_patient, :id_medecin) ");
	$req->execute(array('date_c' => $date_c, 'heure_c' => $heure_c,'duree_c'=> $duree_c,'id_patient' => $id_patient, 'id_medecin' => $id_medecin ));

	echo "Consultation ajoutée";
	?>
	
	<form action="Accueil_consultation.php" method="post">
	<p><input type="submit" value="Retour" name="Bouton" >
	</form>
	</div>
	
	
	
	
    </body>
</html>

