<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Valider modifier medecin</title>
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
	  <li><a class="active" href="Accueil_medecin.php">Médecins</a></li>
	  <li><a href="Accueil_consultation.php">Consultation</a></li>
	  <li><a href="Statistiques.php">Statistiques</a></li>
	</ul>
	
	<?php	
	//print_r($_POST);
	
	if(isset($_POST['civilite'])) {
		$civilite= $_POST['civilite'];	
	}
	if(isset($_POST['nom'])) {
		$nom= $_POST['nom'];	
	}

	if(isset($_POST['prenom'])) {
		$prenom= $_POST['prenom'];
	}
	if(isset($_GET['id_medecin'])) {
		$id_medecin= $_GET['id_medecin'];
	}

	$req = $linkpdo->prepare("UPDATE Medecin SET nom=:nom, prenom=:prenom, civilite=:civilite WHERE id_medecin=:id_medecin");
	$req->execute(array('nom' => $nom, 'prenom' => $prenom, 'civilite' => $civilite, 'id_medecin'=>$id_medecin));
	
	echo 'Le medecin a bien été modifié';
	?>
	<form action="Accueil_medecin.php" method="post">
	<p><input type="submit" value="Retour" name="Bouton" >
	</form>
	
	
    </body>
</html>

