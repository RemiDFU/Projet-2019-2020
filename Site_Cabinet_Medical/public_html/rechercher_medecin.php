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
		
		$linkpdo = connecterBDD();
	?> 
	<ul>
	  <li><a href="Accueil_patient.php">Usagers</a></li>
	  <li><a class="active" href="Accueil_medecin.php">Médecins</a></li>
	  <li><a href="Accueil_consultation.php">Consultation</a></li>
	  <li><a href="Statistiques.php">Statistiques</a></li>
	</ul>
	
	<div id="connexion" >
	<form action="rechercher_medecin.php" method="post">
	<p>Civilité</p>
	<select name="civilite" required >   
    		<option value="M.">M.</option>
    		<option value="Mme">Mme</option>
			<option value="Mlle">Mlle</option>
	</select>
	<p>Nom  : <input type="text" name="nom" /></p>
	<p>Prenom  : <input type="text" name="prenom"/></p>
	<p><input type="submit" value="Rechercher Medecin" name="Bouton"  >
	<p><input type="reset" value="Effacer" name="Bouton"  >
	</form>
	<form action="Accueil_patient.php" method="post">
	<p><input type="submit" value="Retour menu" name="Bouton" >
	
	</form>
	
	<?php

	if(isset($_POST['Bouton'])&&$_POST['Bouton']=="Rechercher Medecin") {

		if(isset($_POST['nom'])) {
			$nom= $_POST['nom'];	
		}
		if(isset($_POST['prenom'])) {
			$prenom= $_POST['prenom'];
		}
		if(isset($_POST['civilite'])) {
			$civilite= $_POST['civilite'];
		}

		$req = $linkpdo->prepare("SELECT * FROM Medecin WHERE nom=:nom OR prenom=:prenom OR civilite=:civilite");
		$req->execute(array('nom' => $nom, 'prenom' => $prenom, 'civilite' => $civilite));
		echo "<table>
	 	 <tr>
	 	 <td>Civilité</td>
	  	 <td>Nom</td>
	 	 <td>Prenom</td>
		 <td>modifier</td>
		 <td>supprimer</td>
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
	}
	
	?>
    </div>
    </body>
</html>

