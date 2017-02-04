<?php session_start();
	if(!empty($_POST['id_dprof']) && !empty($_POST['id_detudiant']) && !empty($_POST['id_dmodule']))
	{
		$_SESSION['cprof'] = $_POST['id_dprof'];
		$_SESSION['cetudiant'] = $_POST['id_detudiant'];
		$_SESSION['cmodule'] = $_POST['id_dmodule'];
		$_SESSION['cdate'] = $_POST['ladate'];
		$_SESSION['chdebut'] = $_POST['hdebut'];
		$_SESSION['chfin'] = $_POST['hfin'];
		header('location: cours.php');
		exit;
	} 
?>