
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Statistiques</title>
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
	  <li><a  href="Accueil_medecin.php">Médecins</a></li>
	  <li><a href="Accueil_consultation.php">Consultation</a></li>
	  <li><a class="active"href="Statistiques.php">Statistiques</a></li>
	</ul>
	
	<?php

	
	$req = $linkpdo->prepare("SELECT COUNT(*) AS NB FROM `Patient` WHERE DATEDIFF( now(), Patient.date_naissance )/365.25 between 0 and 24 AND sexe ='M' ");
	$req->execute();

	while ($data = $req->fetch()) { 
		$nb024M=$data['NB'];
	}
	
	$req->closeCursor();
	
		$req = $linkpdo->prepare("SELECT COUNT(*) AS NB FROM `Patient` WHERE DATEDIFF( now(), Patient.date_naissance )/365.25 between 0 and 24 AND  sexe ='F' ");
	$req->execute();

	while ($data = $req->fetch()) { 
		$nb024F=$data['NB'];
	}
	
	$req->closeCursor();

		$req = $linkpdo->prepare("SELECT COUNT(*) AS NB FROM `Patient` WHERE DATEDIFF( now(), Patient.date_naissance )/365.25 between 25 and 50 AND sexe ='M' ");
	$req->execute();

	while ($data = $req->fetch()) { 
		$nb2550M=$data['NB'];
	}
	
	$req->closeCursor();

		$req = $linkpdo->prepare("SELECT COUNT(*) AS NB FROM `Patient` WHERE DATEDIFF( now(), Patient.date_naissance )/365.25 between 25 and 50 AND sexe ='F' ");
	$req->execute();

	while ($data = $req->fetch()) { 
		$nb2550F=$data['NB'];
	}
	
	$req->closeCursor();

		$req = $linkpdo->prepare("SELECT COUNT(*) AS NB FROM `Patient` WHERE DATEDIFF( now(), Patient.date_naissance )/365.25 > 50 AND sexe ='M' ");
	$req->execute();

	while ($data = $req->fetch()) { 
		$nb50M=$data['NB'];
	}
	
	$req->closeCursor();

			$req = $linkpdo->prepare("SELECT COUNT(*) AS NB FROM `Patient` WHERE DATEDIFF( now(), Patient.date_naissance )/365.25 > 50 AND sexe ='F' ");
	$req->execute();

	while ($data = $req->fetch()) { 
		$nb50F=$data['NB'];
	}
	


	$req->closeCursor();

	$req = $linkpdo->prepare("SELECT Medecin.nom, Medecin.id_medecin, sum(Consultation.duree_c)/60 AS Nbheures FROM `Medecin`, `Consultation` WHERE Medecin.id_medecin = Consultation.id_medecin GROUP BY Medecin.id_medecin ");
	$req->execute();

	while ($data = $req->fetch()) { 
		$nbHeure=$data['Nbheures'];
	}
	
	$req->closeCursor();
		
	

	// Affichage du tableau


	?>

	<h4>Répartition des usagers selon leur sexe et leur âge</h4>

	<table>
	   <tr>

	       <th>Tranche d'age</th>
	       <th>Nb hommes</th>
	       <th>Nb femmes</th>
	   </tr>

	   <tr>
	       <td>Moins de 25 ans</td>
	       <td><?php echo $nb024M ?></td>
	       <td><?php echo $nb024F ?></td>
	   </tr>

	   <tr>

	       <td>Entre 25 et 50 ans</td>
	       <td><?php echo $nb2550M ?></td>
	       <td><?php echo $nb2550F ?></td>
	   </tr>
	   <tr>
	       <td>Plus de 50 ans</td>
	       <td><?php echo $nb50M ?></td>
	       <td><?php echo $nb50F ?></td>
	   </tr>

	</table>
	<br>
	<h4>Durée totale des consultations effectuées par chaque médecin (en nombre d'heures)</h4>
	<table>
		<tr>
			<th>Nom</th>
	 		<th>NbHeures</th>
		</tr>
	<?php
		$req = $linkpdo->prepare("SELECT Medecin.nom, Medecin.id_medecin, sum(Consultation.duree_c)/60 AS NB FROM `Medecin`, `Consultation` WHERE Medecin.id_medecin = Consultation.id_medecin GROUP BY Medecin.id_medecin ");
	$req->execute(); 

	while ($data = $req->fetch()) { 
		echo "<tr>";
		echo "<td>".$data['nom']."</td>";
	    	echo "<td>".$data['NB']."</td>";
		echo "</tr>";
	}
	$req->closeCursor();
	?>
	</table>
	</br>
	
	<form action="menu.php" method="post">
	<p><input type="submit" value="Retour" name="Bouton" >
	</form>
    </body>
</html>

