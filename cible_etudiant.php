<?php 
	session_start();

	if(!empty($_POST['prenom_et']) && !empty($_POST['nom_et']) && !empty($_POST['sexe_et']) && !empty($_POST['grade_et']) && !empty($_POST['niveau_et']) && !empty($_POST['filiere_et']))
	{
		$_SESSION['prenom_et'] = $_POST['prenom_et'];
		$_SESSION['nom_et'] = $_POST['nom_et'];
		$_SESSION['sexe_et'] = $_POST['sexe_et'];
		$_SESSION['grade_et'] = $_POST['grade_et'];
		$_SESSION['niveau_et'] = $_POST['niveau_et'];
		$_SESSION['filiere_et'] = $_POST['filiere_et'];

		header('location: etudiant.php');
		exit;
	}

?>
