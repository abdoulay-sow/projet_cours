<?php session_start();
	if(!empty($_POST['numero2']))
	{
		$_SESSION['numero2'] = $_POST['numero2'];

		header("location: assiduite.php");
		exit;
	}
	 ?>