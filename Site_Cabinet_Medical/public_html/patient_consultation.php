<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>consultation patient</title>
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

	
	$req = $linkpdo->prepare("SELECT * FROM Patient ");
	$req->execute();
	echo "<table>
	<tr>
		<td>Civilité</td>
	  	<td>Nom</td>
	 	<td>Prenom</td>
		<td>Date de naissance</td>
		<td>ajouter</td>
	</tr>";

	while ($data = $req->fetch()) { 
		echo "<tr>";
		echo "<td>".$data['civilite']."</td>";
		echo "<td>".$data['nom']."</td>";
	    	echo "<td>".$data['prenom']."</td>";
	   	echo "<td>".$data['date_naissance']."</td>";
		echo "<td><a href=\"saisie_consultation.php?id_patient=".$data['id_patient']."\">ajouter saisie</td>";
		echo "</tr>";
	}
	$req->closeCursor();
	echo "</table>";	
	
	?>
	<form action="rechercher_patient.php" method="post">
	<p><input type="submit" value="Rechercher patient" name="Bouton" >
	</form>
    </body>
</html>

