<?php session_start();
if(!empty($_POST['matricule']) && !empty($_POST['numero']) && !empty($_POST['module']) && !empty($_POST['motif']) && !empty($_POST['heure']))
	{
		$_SESSION['matricule'] = $_POST['matricule'];
		$_SESSION['numero'] = $_POST['numero'];
		$_SESSION['module'] = $_POST['module'];
		$_SESSION['motif'] = $_POST['motif'];
		$_SESSION['heure'] = $_POST['heure'];

		header('location: assiduite.php');
		exit;
	} ?>