<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Rechercher patient</title>
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
	
	<div id="connexion" >
	<form action="rechercher_patient.php" method="post">
	<p>Civilité</p>
	<select name="civilite" required >   
    		<option value="M.">M.</option>
    		<option value="Mme">Mme</option>
			<option value="Mlle">Mlle</option>
	</select>
	<p>Nom  : <input type="text" name="nom" /></p>
	<p>Prenom  : <input type="text" name="prenom"/></p>
	<p>Adresse  : <input type="text" name="adresse"/></p>
	<p>Code Postal : <input type="text" name="code_postal"/></p>
	<p>Ville : <input type="text" name="ville"/></p>
	<p>Date de naissance : <input type="date" name="date_naissance"/></p>
	<p>Ville de naissance : <input type="text" name="lieu_naissance"/></p>
	<p>Numéro de Sécu : <input type="text" name="numero_secu"/></p>
	<p>Medecin référent : <input type="text" name="medecin_ref"/></p>
	<p><input type="submit" value="Rechercher Patient" name="Bouton"  >
	<p><input type="reset" value="Effacer" name="Bouton"  >
	</form>
	<form action="Accueil_patient.php" method="post">
	<p><input type="submit" value="Retour menu" name="Bouton" >
	</form>

	</div >
	<?php

	if(isset($_POST['Bouton'])&&$_POST['Bouton']=="Rechercher Patient") {

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
		if(isset($_POST['civilite'])) {
			$civilite= $_POST['civilite'];
		}


		$req = $linkpdo->prepare("SELECT * FROM Patient WHERE civilite=:civilite OR nom=:nom OR prenom=:prenom OR adresse=:adresse OR code_postal=:code_postal Or ville=:ville Or numero_secu=:numero_secu Or date_naissance=:date_naissance Or lieu_naissance=:lieu_naissance");
		$req->execute(array('civilite' => $civilite,'nom' => $nom, 'prenom' => $prenom, 'adresse' => $adresse, 'code_postal' => $code_postal, 'ville' => $ville, 'lieu_naissance' => $lieu_naissance, 'date_naissance' =>$date_naissance, 'numero_secu' =>$numero_secu ));
		echo "<table>
	 	 <tr>
	 	 	<td>Civilité</td>
	  	  <td>Nom</td>
	 	   <td>Prenom</td>
	 	   <td>Adresse</td>
	 	   <td>CodePostal</td>
		    <td>Ville</td>
		    <td>Date de naissance</td>
		    <td>Ville de naissance</td>
		    <td>Numéro de Sécu</td>
		    <td>modifier</td>
		    <td>supprimer</td>
		  </tr>";

		while ($data = $req->fetch()) { 
			echo "<tr>";
			echo "<td>".$data['civilite']."</td>";
			echo "<td>".$data['nom']."</td>";
		    	echo "<td>".$data['prenom']."</td>";
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
	}
	
	?>
	
    </body>
</html>

