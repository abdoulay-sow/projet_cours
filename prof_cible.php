<?php 
	session_start();

	if(!empty($_POST['prenom_prof']) && !empty($_POST['nom_prof']))
	{
		$_SESSION['prenom'] = $_POST['prenom_prof'];
		$_SESSION['nom'] = $_POST['nom_prof'];

		header('location: professeur.php');
		exit;	
	}
?>
