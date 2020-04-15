<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>Saisie consultation</title>
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
	  <li><a href="Accueil_medecin.php">Médecins</a></li>
	  <li><a class="active" href="Accueil_consultation.php">Consultation</a></li>
	  <li><a href="Statistiques.php">Statistiques</a></li>
	</ul>
	
	<?php	
	

	if(isset($_GET['id_patient'])){
		$id_patient=$_GET['id_patient'];
	}
	$req = $linkpdo->prepare("SELECT id_medecin FROM Patient WHERE id_patient =".$id_patient);
	$req->execute();
	while ($data = $req->fetch()) { 
		$id_medecin=$data['id_medecin'];
	}
	if($id_medecin==NULL){
		$id_medecin=-1;
	}

	?>

	<p> Medecin : </p>
	<div id="connexion" >
	<form action="valider_ajout_consultation.php" method="post">
	  	<select name="id_medecin" >
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
			?>
	  	</select>
		<br>
		<p> Date et heure </p>
		<input name="date_c" type="date" value="<?php echo date("Y-m-d"); ?>" required/>
		<input name="heure_c" type="time" value="<?php echo date("H:i"); ?>" required/>
		<p> Durée </p>
		<input name="duree_c" type="int" value="30" required/>
		<input name="id_patient" type="hidden" value="<?php echo $id_patient; ?>"/>
	 	<br><br>
	  	<input type="submit" value="Valider" name="Bouton" >
	
	</form>
	</div>

	
	

	
</body>
</html>

