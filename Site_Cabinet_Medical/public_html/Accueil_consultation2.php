<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Accueil Consultation</title>
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
		if(isset($_POST['id_medecin'])){
			$id_medecin=$_POST['id_medecin'];
		}
		
	?>  
	<ul>
	  <li><a href="Accueil_patient.php">Usagers</a></li>
	  <li><a href="Accueil_medecin.php">Médecins</a></li>
	  <li><a class="active" href="Accueil_consultation.php">Consultation</a></li>
	  <li><a href="Statistiques.php">Statistiques</a></li>
	</ul>


	<p>Choisir Médecin </p>
	<form action="Accueil_consultation2.php" method="post">
        <select name="id_medecin" onchange='form.submit()' >
			<?php		
			$req = $linkpdo->prepare("SELECT id_medecin, nom, prenom FROM Medecin WHERE id_medecin =".$id_medecin);
			$req->execute();
			while ($data = $req->fetch()) { 
				echo "<option value='".$data['id_medecin']."'>".$data['nom']." ".$data['prenom']."</option>";
			}
			$req->closeCursor();

			$req = $linkpdo->prepare("SELECT id_medecin, nom, prenom FROM Medecin where id_medecin !=".$id_medecin);
			$req->execute();
			while ($data = $req->fetch()) { 
				echo "<option value='".$data['id_medecin']."'>".$data['nom']." ".$data['prenom']."</option>";
			}
			$req->closeCursor();
			?>
  	</select>
	</form>		
	
	<?php	
	$req = $linkpdo->prepare("SELECT * FROM Consultation where id_medecin =:id_medecin order by date_c DESC ");
	$req->execute(array('id_medecin' => $id_medecin));
	echo "<table>
	<tr>
		<th>Date</th>
	  	<th>Heure</th>
	 	<th>Duree</th>
	 	<th>Patient</th>
	 	<th>Medecin</th>
		<th>Modifier</th>
		<th>Supprimer</th>
		
	</tr>";

	while ($data = $req->fetch()) { 
		echo "<tr>";
		echo "<td>".$data['date_c']."</td>";
		echo "<td>".$data['heure_c']."</td>";
	    echo "<td>".$data['duree_c']."</td>";

		$req2 = $linkpdo->prepare("SELECT nom, prenom FROM Patient WHERE id_patient =:id_patient ");
		$req2->execute(array('id_patient' => $data['id_patient']));

		while ($data2 = $req2->fetch()) { 
	    	echo "<td>".$data2['nom']." ".$data2['prenom']."</td>";
		}
		$req2->closeCursor();

		$req2 = $linkpdo->prepare("SELECT nom, prenom FROM Medecin WHERE id_medecin =:id_medecin ");
		$req2->execute(array('id_medecin' => $data['id_medecin']));

		while ($data2 = $req2->fetch()) { 
	    	echo "<td>".$data2['nom']." ".$data2['prenom']."</td>";
		}
		$req2->closeCursor();
		echo "<td><a href=\"modification_consultation.php?id_patient=".$data['id_patient']."&id_medecin=".$data['id_medecin']."&date_c=".$data['date_c']."&heure_c=".$data['heure_c']."&duree_c=".$data['duree_c']."\">modifier</a></td>";
		echo "<td><a href=\"supprimer_consultation.php?id_patient=".$data['id_patient']."&id_medecin=".$data['id_medecin']."&date_c=".$data['date_c']."&heure_c=".$data['heure_c']."&duree_c=".$data['duree_c']."\">supprimer</td>";
		echo "</tr>";
		echo "</tr>";
	}
	$req->closeCursor();
	echo "</table>";		
	

	
	?>
	<form action="choisir_patient.php" method="post">
	<p><input type="submit" value="Ajouter" name="Bouton" >
	</form>

	<form action="menu.
php" method="post">
	<p><input type="submit" value="retour" name="Bouton" >
	</form>
	
    </body>
</html>

