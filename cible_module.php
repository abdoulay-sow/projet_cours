<?php
session_start();
if(!empty($_POST['mod']))
{
		$_SESSION['mod'] = $_POST['mod'];
	
		header('location: module.php');
		exit;	
}
?>