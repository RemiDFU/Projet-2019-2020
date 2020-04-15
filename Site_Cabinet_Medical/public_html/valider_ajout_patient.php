<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Ajouter patient</title>
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

	
	<?php	
	
	if(isset($_POST['civilite'])) {
		$civilite= $_POST['civilite'];	
	}
	if(isset($_POST['sexe'])) {
		$sexe= $_POST['sexe'];	
	}
	if(isset($_POST['nom'])) {
		$nom= $_POST['nom'];	
	}
	if(isset($_POST['prenom'])) {
		$prenom= $_POST['prenom'];
	}
	if(isset($_POST['adresse'])) {
		$adresse= $_POST['adresse'];
	}
	if(isset($_POST['code_postal'])) {
		$code_postal= $_POST['code_postal'];
	}
	if(isset($_POST['ville'])) {
		$ville= $_POST['ville'];
	}
	if(isset($_POST['numero_secu'])) {
		$numero_secu= $_POST['numero_secu'];
	}
	if(isset($_POST['date_naissance'])) {
		$date_naissance= $_POST['date_naissance'];
	}
	if(isset($_POST['lieu_naissance'])) {
		$lieu_naissance= $_POST['lieu_naissance'];
	}
	if(isset($_POST['id_medecin'])) {
		$id_medecin= $_POST['id_medecin'];
	}
	
 
	$req = $linkpdo->prepare("INSERT INTO Patient(`nom`, `prenom`, `civilite`, `code_postal`, `ville`, `date_naissance`, `lieu_naissance`, `adresse`, `numero_secu`, `id_medecin`,sexe) VALUES(:nom , :prenom, :civilite, :code_postal, :ville, :date_naissance, :lieu_naissance, :adresse, :numero_secu, :id_medecin,:sexe) ");
	$req->execute(array('nom' => $nom, 'prenom' => $prenom,'civilite' => $civilite, 'code_postal' => $code_postal, 'ville' => $ville, 'date_naissance' =>$date_naissance, 'lieu_naissance' => $lieu_naissance, 'adresse' => $adresse, 'numero_secu' =>$numero_secu, 'id_medecin'=> $id_medecin, 'sexe'=> $sexe  ));

	echo "Patient ajouté"
	?>
	
	<form action="Accueil_patient.php" method="post">
	<p><input type="submit" value="Accueil" name="Bouton" >
	</form>
    </body>
</html>

