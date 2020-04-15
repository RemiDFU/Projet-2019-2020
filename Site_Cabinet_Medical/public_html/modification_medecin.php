<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>modifier medecin</title>
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
	
	<?php	
	//print_r($_POST);
	

	if(isset($_GET['id_medecin'])) {
		$id_medecin= $_GET['id_medecin'];
		$req = $linkpdo->prepare("SELECT * FROM Medecin WHERE id_medecin=:id_medecin");
		$req->execute(array('id_medecin' => $id_medecin));
		while ($data = $req->fetch()) {
			$civilite=$data['civilite'];
			$nom=$data['nom'];
			$prenom=$data['prenom'];
		}
		
	}
	?>
	<div id="connexion" >
	<form action="validerModification_medecin.php?id_medecin=<?php echo $id_medecin ?>" method="post">
	<p>Civilité</p>
	<select name="civilite" required >   
    		<option value="M.">M.</option>
    		<option value="Mme">Mme</option>
			<option value="Mlle">Mlle</option>
	</select>
	<p>Nom  : <input type="text" name="nom" value= "<?php echo $nom ?>"/></p>
	<p>Prenom  : <input type="text" name="prenom" value= "<?php echo $prenom ?>"/></p>
	<p><input type="submit" value="Valider" name="Bouton"  >
	</form>
	</div>
	

	
	
    </body>
</html>

