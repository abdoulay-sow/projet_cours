<?php 
	session_start();
	if(!empty($_POST['matricule']) && !empty($_POST['module']))
	{
		$_SESSION['matricule'] = $_POST['matricule'];
		$_SESSION['module'] = $_POST['module'];

		header('location: enseigner.php');
		exit;
	} 
	?>