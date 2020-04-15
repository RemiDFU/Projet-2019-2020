<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" /><link rel="stylesheet" type="text/css" href=css_projet_php.css  />
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
	<form action="valider_ajout_patient.php" method="post">
	<p>Civilité</p>
	<select name="civilite" required >   
    		<option value="M.">M.</option>
    		<option value="Mme">Mme</option>
			<option value="Mlle">Mlle</option>
	</select>
	<p>Sexe</p>
	<select name="sexe" required>   
    		<option value="M">M</option>
    		<option value="F">F</option>
	</select>
	<p>Nom  : <input type="text" name="nom" required/></p>
	<p>Prenom  : <input type="text" name="prenom" required/></p>
	<p>Adresse  : <input type="text" name="adresse" required/></p>
	<p>Code Postal : <input type="text" name="code_postal" required/></p>
	<p>Ville : <input type="text" name="ville" required/></p>
	<p>Date de naissance : <input type="date" name="date_naissance" required/></p>
	<p>Ville de naissance : <input type="text" name="lieu_naissance" required/></p>
	<p>Numéro de Sécu : <input type="text" name="numero_secu" required/></p>
	<p>Medecin référent</p>
        <select name="id_medecin" >
			<option value='NULL'>Aucun</option>
			<?php	
			$req = $linkpdo->prepare("SELECT id_medecin, nom, prenom FROM Medecin");
			$req->execute();
			while ($data = $req->fetch()) { 
				echo "<option value='".$data['id_medecin']."'>".$data['nom']." ".$data['prenom']."</option>";
			}
			$req->closeCursor();

			?>
	</select>
	<p><input type="submit" value="Ajouter" name="Bouton"  >
	<p><input type="reset" value="Effacer" name="Bouton"  >
	</form>
	<form action="Accueil_patient.php" method="post">
	<p><input type="submit" value="Retour" name="Bouton" >
	</form>

	</div >

	
    </body>
</html>

