<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href=css_projet_php.css  />
</head>
        <title>Menu</title>
    </head>
    <body>
	<?php
		//echo print_r($_POST);

		include('fonction.php');

		if(isset($_POST['login'])){
			$postLogin= $_POST['login'];
		}else{
			$postLogin="";
		}
		if(isset($_POST['password'])){
			$postPassword= $_POST['password'];
		}else{
			$postPassword="";
		}

		if(!seConnecter($postLogin,$postPassword)){
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
		}


		
	?> 
	<ul>
	  <li><a class="active" href="Accueil_patient.php">Usagers</a></li>
	  <li><a href="Accueil_medecin.php">Médecins</a></li>
	  <li><a href="Accueil_consultation.php">Consultation</a></li>
	  <li><a href="Statistiques.php">Statistiques</a></li>
	</ul>

	
        <h1>Bienvenue dans le cabinet</h1>
	
	


    </body>
</html>

