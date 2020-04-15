<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Suprression Consultation</title>
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
	  <li><a href="Accueil_medecin.php">Médecins</a></li>
	  <li><a class="active" href="Accueil_consultation.php">Consultation</a></li>
	  <li><a href="Statistiques.php">Statistiques</a></li>
	</ul>
	
	<?php	
	//print_r($_GET);
	
	if(isset($_GET['id_patient'])){
		$id_patient=$_GET['id_patient'];
		
	}
	if(isset($_GET['date_c'])){
		$date_c=$_GET['date_c'];
		
	}
	if(isset($_GET['heure_c'])){
		$heure_c=$_GET['heure_c'];
		
	}
	if(isset($_GET['id_medecin'])){
		$id_medecin=$_GET['id_medecin'];
		
	}
	?>
	<p>Voulez-vous supprimer cette consultation ?</p>
	<form action="Accueil_consultation.php" method="post">
	<input type="hidden" value="<?php echo $id_patient?>" name="id_patient" >
	<input type="hidden" value="<?php echo $date_c?>" name="date_c" >
	<input type="hidden" value="<?php echo $heure_c?>" name="heure_c" >	
	<input type="hidden" value="<?php echo $id_medecin?>" name="id_medecin" >
	<p><input type="submit" value="Supprimer" name="Bouton" >
	</form>

	<form action="Accueil_medecin.php" method="post">
	<p><input type="submit" value="Retour" name="Bouton" >
	</form>


    </body>
</html>

