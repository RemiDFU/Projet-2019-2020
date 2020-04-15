<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
        <title>modifier patient</title>
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
		Jeremy
		$linkpdo = connecterBDD();
	?> 
	<ul>
	  <li><a class="active" href="Accueil_patient.php">Usagers</a></li>
	  <li><a href="Accueil_medecin.php">Médecins</a></li>
	  <li><a href="Accueil_consultation.php">Consultation</a></li>
	  <li><a href="Statistiques.php">Statistiques</a></li>
	</ul>

	
	<?php	
	//print_r($_POST);
	

	if(isset($_GET['id_patient'])) {
		$id_patient= $_GET['id_patient'];
		$req = $linkpdo->prepare("SELECT * FROM Patient WHERE id_patient=:id_patient");
		$req->execute(array('id_patient' => $id_patient));
		while ($data = $req->fetch()) {
			$civilite=$data['civilite'];
			$nom=$data['nom'];
			$prenom=$data['prenom'];
			$adresse=$data['adresse'];
			$code_postal=$data['code_postal'];
			$ville=$data['ville'];
			$numero_secu= $data['numero_secu'];
			$date_naissance= $data['date_naissance'];
			$lieu_naissance= $data['lieu_naissance'];
			$id_medecin= $data['id_medecin'];
			$sexe= $data['sexe'];
		}
		$req = $linkpdo->prepare("SELECT * FROM Medecin WHERE id_medecin=:id_medecin");
		$req->execute(array('id_medecin' => $id_medecin));
		while ($data = $req->fetch()) {
			$nom_medecin= $data['nom'];
		}
		
	}
	?>
	<div id="connexion" >
	<form action="validerModification_patient.php?id_patient=<?php echo $id_patient ?>" method="post">
	<p>Civilité</p>
	<select name="civilite"  value= "<?php echo $civilite ?>" required>   
    		<option value="M." <?php if($civilite=='M.'){echo "selected='selected'";} ?>>M.</option>
    		<option value="Mme" <?php if($civilite=='Mme'){echo "selected='selected'";} ?>>Mme</option>
		<option value="Mlle" <?php if($civilite=='Mlle'){echo "selected='selected'";} ?>>Mlle</option>
	</select>
	<p>Sexe</p>
	<select name="sexe" required>   
    		<option value="M" <?php if($sexe=='M'){echo "selected='selected'";} ?>>M</option>
    		<option value="F" <?php if($sexe=='F'){echo "selected='selected'";} ?>>F</option>
	</select>
	<p>Nom  : <input type="text" name="nom" value='<?php echo $nom?>' required/></p>
	<p>Prenom  : <input type="text" name="prenom"  value='<?php echo $prenom?>' required/></p>
	<p>Adresse  : <input type="text" name="adresse"  value='<?php echo $adresse?>' required/></p>
	<p>Code Postal : <input type="text" name="code_postal"  value='<?php echo $code_postal?>' required/></p>
	<p>Ville : <input type="text" name="ville"  value='<?php echo $ville?>' required/></p>
	<p>Date de naissance : <input type="date" name="date_naissance"  value='<?php echo $date_naissance?>' required/></p>
	<p>Ville de naissance : <input type="text" name="lieu_naissance"  value='<?php echo $lieu_naissance?>' required/></p>
	<p>Numéro de Sécu : <input type="text" name="numero_secu"  value='<?php echo $numero_secu?>' required/></p>
	<p>Medecin référent</p>
        <select name="id_medecin" >
			
			<?php	
			$req = $linkpdo->prepare("SELECT id_medecin, nom, prenom FROM Medecin WHERE id_medecin =".$id_medecin);
			$req->execute();
			while ($data = $req->fetch()) { 
				echo "<option value='".$data['id_medecin']."'>".$data['nom']." ".$data['prenom']."</option>";
			}
			$req->closeCursor();
			?>
			<option value='NULL'>Aucun</option>
			<?php
			$req = $linkpdo->prepare("SELECT id_medecin, nom, prenom FROM Medecin where id_medecin !=".$id_medecin);
			$req->execute();
			while ($data = $req->fetch()) { 
				echo "<option value='".$data['id_medecin']."'>".$data['nom']." ".$data['prenom']."</option>";
			}
			?>
	  	</select>
	<p><input type="submit" value="Valider" name="Bouton"  >
	</form>
	</div> 

	
    </body>
</html>

