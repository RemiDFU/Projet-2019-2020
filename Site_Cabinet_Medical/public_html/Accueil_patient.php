<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Accueil patient</title>
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

		if(isset($_POST['Bouton'])&&$_POST['Bouton']=="Supprimer"&&isset($_GET['id_patient'])) {
		$id_patient= $_GET['id_patient'];
		$req = $linkpdo->prepare("DELETE FROM Patient WHERE id_patient=:id_patient");
		$req->execute(array('id_patient' => $id_patient));
	}
	?> 
	<ul>
	  <li><a class="active" href="Accueil_patient.php">Usagers</a></li>
	  <li><a href="Accueil_medecin.php">Médecins</a></li>
	  <li><a href="Accueil_consultation.php">Consultation</a></li>
	  <li><a href="Statistiques.php">Statistiques</a></li>
	</ul>
        <h1>Accueil patient</h1>
	
	<?php	
	

	
	$req = $linkpdo->prepare("SELECT * FROM Patient ");
	$req->execute();
	echo "<table>
	<tr>
		<th>Civilité</th>
	  	<th>Nom</th>
	 	<th>Prenom</th>
		<th>Sexe</th>
	 	<th>Adresse</th>
	 	<th>CodePostal</th>
		<th>Ville</th>
		<th>Date de naissance</th>
		<th>Ville de naissance</th>
		<th>Numéro de Sécu</th>
		<th>modifier</th>
		<th>supprimer</th>
	</tr>";

	while ($data = $req->fetch()) { 
		echo "<tr>";
		echo "<td>".$data['civilite']."</td>";
		echo "<td>".$data['nom']."</td>";
	    	echo "<td>".$data['prenom']."</td>";
		echo "<td>".$data['sexe']."</td>";
	    	echo "<td>".$data['adresse']."</td>";
	    	echo "<td>".$data['code_postal']."</td>";
	    	echo "<td>".$data['ville']."</td>";
	   	echo "<td>".$data['date_naissance']."</td>";
	  	echo "<td>".$data['lieu_naissance']."</td>";
	 	echo "<td>".$data['numero_secu']."</td>";
		echo "<td><a href=\"modification_patient.php?id_patient=".$data['id_patient']."\">modifier</a></td>";
		echo "<td><a href=\"supprimerPatient.php?id_patient=".$data['id_patient']."\">supprimer</td>";
		echo "</tr>";
	}
	$req->closeCursor();
	echo "</table>";	
	

	
	?>
	
	<form action="ajouter_patient.php" method="post">
	<p><input type="submit" value="Ajouter" name="Bouton" >
	</form>
	<form action="rechercher_patient.php" method="post">
	<p><input type="submit" value="Rechercher" name="Bouton" >
	</form>
    </body>
</html>

