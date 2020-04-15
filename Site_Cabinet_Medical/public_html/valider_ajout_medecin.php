<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Ajouter medecin</title>
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
	
	if(isset($_POST['civilite'])) {
		$civilite= $_POST['civilite'];	
	}
	if(isset($_POST['nom'])) {
		$nom= $_POST['nom'];	
	}
	if(isset($_POST['prenom'])) {
		$prenom= $_POST['prenom'];
	}
	
 
	$req = $linkpdo->prepare("INSERT INTO Medecin(nom, prenom, civilite) VALUES(:nom , :prenom, :civilite) ");
	$req->execute(array('nom' => $nom, 'prenom' => $prenom,'civilite' => $civilite));

	echo "Medecin ajouté"
	?>
	
	<form action="Accueil_medecin.php" method="post">
	<p><input type="submit" value="Accueil" name="Bouton" >
	</form>
    </body>
</html>

