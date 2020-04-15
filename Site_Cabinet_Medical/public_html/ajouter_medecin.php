<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Rechercher medecin</title>
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
	
	<div id="connexion" >
	<form action="valider_ajout_medecin.php" method="post">
	<p>Civilité</p>
	<select name="civilite" required >   
    		<option value="M.">M.</option>
    		<option value="Mme">Mme</option>
			<option value="Mlle">Mlle</option>
	</select>
	<p>Nom  : <input type="text" name="nom"required /></p>
	<p>Prenom  : <input type="text" name="prenom"required/></p>
	<p><input type="submit" value="Ajouter" name="Bouton"  >
	<p><input type="reset" value="Effacer" name="Bouton"  >
	</form>
	<form action="Accueil_medecin.php" method="post">
	<p><input type="submit" value="Retour" name="Bouton" >
	</form>
	</div>

	
    </body>
</html>

