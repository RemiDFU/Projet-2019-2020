<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />

        <title>Accueil medecin</title>
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
	</br>
	<?php	
	
	if(isset($_POST['Bouton'])&&$_POST['Bouton']=="Supprimer"&&isset($_GET['id_medecin'])) {
		$id_medecin= $_GET['id_medecin'];
		$req = $linkpdo->prepare("DELETE FROM Medecin WHERE id_medecin=:id_medecin");
		$req->execute(array('id_medecin' => $id_medecin));
	}
	
	$req = $linkpdo->prepare("SELECT * FROM Medecin ");
	$req->execute();
	echo "<table>
	<tr>
		<th>Civilité</th>
	  	<th>Nom</th>
	 	<th>Prenom</th>
		<th>modifier</th>
		<th>supprimer</th>
	</tr>";

	while ($data = $req->fetch()) { 
		echo "<tr>";
		echo "<td>".$data['civilite']."</td>";
		echo "<td>".$data['nom']."</td>";
	    	echo "<td>".$data['prenom']."</td>";
		echo "<td><a href=\"modification_medecin.php?id_medecin=".$data['id_medecin']."\">modifier</a></td>";
		echo "<td><a href=\"supprimer_medecin.php?id_medecin=".$data['id_medecin']."\">supprimer</td>";
		echo "</tr>";
	}
	$req->closeCursor();
	echo "</table>";	
	

	
	?>
	<form action="ajouter_medecin.php" method="post">
	<p><input type="submit" value="Ajouter" name="Bouton" >
	</form>
	<form action="rechercher_medecin.php" method="post">
	<p><input type="submit" value="Rechercher" name="Bouton" >
	</form>
    </body>
</html>

