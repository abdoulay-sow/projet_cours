<?php 
	session_start(); 
	if(isset($_SESSION['matricule']) && isset($_SESSION['module']))
	{
		$_POST['matricule'] = $_SESSION['matricule'];
		$_POST['module']= $_SESSION['module'];

		unset($_SESSION['matricule'], $_SESSION['module']);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Enseigner</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/principal.css">
</head>
<body>
<header>
	<a href="deconnexion.php">Deconnexion</a>
</header>
<?php include("nav.php"); ?>
<main>
<h2>Insertion Enseigner</h2>
	<form method="POST" action="cible_enseigner.php">
	<table>
		<tr><td><label>Matricule Professeur : </label></td><td><input type="number" name="matricule" required></td></tr>
		<tr><td><label>Id Module : </label></td><td><input type="number" name="module" required></td></tr>
		<tr><td colspan="2"><input type="submit" value="Envoyer"></td></tr>
	</table>
	</form>
</main>
<?php 
	if(!empty($_POST['matricule']) && !empty($_POST['module']))
	{
		$link = mysqli_connect("localhost","root","root","base_assiduite")
			or die("Impossible de se connecter à la BDD");
		if($req = mysqli_prepare($link,"INSERT INTO enseigner (matricule, id_module) VALUES (?, ?)")){
			mysqli_stmt_bind_param($req, "ii", $_POST['matricule'], $_POST['module']);
			mysqli_execute($req);
			mysqli_stmt_close($req);
		}
		else{echo "Requête invalide";}
		mysqli_close($link);
	}
?>
</body>
</html>