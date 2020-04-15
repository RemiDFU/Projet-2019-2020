<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Suprression patient</title>
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
	  <li><a class="active" href="Accueil_patient.php">Usagers</a></li>
	  <li><a href="Accueil_medecin.php">Médecins</a></li>
	  <li><a href="Accueil_consultation.php">Consultation</a></li>
	  <li><a href="Statistiques.php">Statistiques</a></li>
	</ul>
	
	<?php	
	if(isset($_GET['id_patient'])) {
		$id_patient= $_GET['id_patient'];
	}
	?>
	
	<form action="Accueil_patient.php?id_patient=<?php echo $id_patient ?>" method="post">
	<p><input type="submit" value="Supprimer" name="Bouton" >
	</form>

	<form action="rechercher_patient.php" method="post">
	<p><input type="submit" value="Retour" name="Bouton" >
	</form>


    </body>
</html>

