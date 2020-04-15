<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Valider modification consultation</title>
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
	  <li><a class="active" href="Accueil_patient.php">Usagers</a></li>
	  <li><a href="Accueil_medecin.php">Médecins</a></li>
	  <li><a href="Accueil_consultation.php">Consultation</a></li>
	  <li><a href="Statistiques.php">Statistiques</a></li>
	</ul>
        <h1>Valider modifier consultation</h1>
	
	<?php	
	//print_r($_POST);
	
	if(isset($_POST['date_c'])) {
		$date_c= $_POST['date_c'];	
	}
	if(isset($_POST['heure_c'])) {
		$heure_c= $_POST['heure_c'];	
	}
	if(isset($_POST['duree_c'])) {
		$duree_c= $_POST['duree_c'];
	}
	if(isset($_POST['id_patient'])) {
		$id_patient= $_POST['id_patient'];
	}
	if(isset($_POST['id_medecin'])) {
		$id_medecin= $_POST['id_medecin'];
		echo $id_medecin;
	}
	
	if(chevauchement($id_medecin, $date_c, $heure_c, $duree_c)>0){
		echo "Vous ne pouvez pas ajouter de consultation car il y a un chevauchement";
		echo "<form action=\"Accueil_consultation.php\" method=\"post\">
	<p><input type=\"submit\" value=\"Retour\" name=\"Bouton\" >
	</form>";
		exit;
	}


	$req = $linkpdo->prepare("UPDATE Consultation SET date_c=:date_c,heure_c=:heure_c,duree_c=:duree_c,id_patient=:id_patient,id_medecin=:id_medecin WHERE date_c=:date_c AND heure_c=:heure_c AND id_patient=:id_patient AND id_medecin=:id_medecin");
	$req->execute(array('date_c' => $date_c, 'heure_c' => $heure_c, 'duree_c' => $duree_c, 'id_patient' => $id_patient, 'id_medecin' => $id_medecin));
		echo "Votre consultation a bien été modifié";
	?>
	<form action="Accueil_consultation.php" method="post">
	<p><input type="submit" value="Retour" name="Bouton" >
	</form>
	
	
    </body>
</html>

