<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Suprression medecin</title>
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
		
		
	?> 
	<ul>
	  <li><a href="Accueil_patient.php">Usagers</a></li>
	  <li><a class="active" href="Accueil_medecin.php">Médecins</a></li>
	  <li><a href="Accueil_consultation.php">Consultation</a></li>
	  <li><a href="Statistiques.php">Statistiques</a></li>
	</ul>
	
	<?php	
	//print_r($_POST);
	
	if(isset($_GET['id_medecin'])) {
		$id_medecin= $_GET['id_medecin'];
	}
	?>
	<p>Voulez-vous supprimer ce medecin ?</p>
	<form action="Accueil_medecin.php?id_medecin=<?php echo $id_medecin ?>" method="post">
	<p><input type="submit" value="Supprimer" name="Bouton" >
	</form>

	<form action="Accueil_medecin.php" method="post">
	<p><input type="submit" value="Retour" name="Bouton" >
	</form>


    </body>
</html>

