<?php 
session_start();
if(isset($_SESSION['prenom']) && isset($_SESSION['nom']))
	{
		$_POST['prenom_prof'] = $_SESSION['prenom'];
		$_POST['nom_prof'] = $_SESSION['nom'];

		unset($_SESSION['prenom'], $_SESSION['nom']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Professeur</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/principal.css">
</head>
<body>
<header><a href="deconnexion.php">Deconnexion</a></header>
<?php include('nav.php') ?>
<main>
	<h2>Insertion Professeur</h2> 
	<form method="POST" action="prof_cible.php">
		<table>
			<tr>
			<td><label>Prénom: </label></td>
			<td><input type="text" name="prenom_prof" required></td>
			</tr>
			<tr>
			<td><label>Nom: </label></td>
			<td><input type="text" name="nom_prof" required></td>
			</tr>
			<tr>
			<td colspan="2"><input type="submit" value="Envoyer"></td>
			</tr>
		</table>
	</form>
</main>
<?php
if(!empty($_POST['prenom_prof']) && !empty($_POST['nom_prof'])){
	$link = mysqli_connect("localhost","root","root","base_assiduite")
		or die('Impossible de se connecter à la base');
	if($stmt = mysqli_prepare($link, 'INSERT INTO professeur (prenom, nom) VALUES(?, ?)'))
	{
		mysqli_stmt_bind_param($stmt, "ss", $_POST['prenom_prof'], $_POST['nom_prof']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	else
	{
		echo "<br>Impossible de préparer la requête";
	}
	mysqli_close($link);
}
?>
</body>
</html>