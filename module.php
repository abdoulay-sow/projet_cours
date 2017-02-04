<?php 
session_start();
if(isset($_SESSION['mod'])){
	$_POST['mod'] = $_SESSION['mod'];

	unset($_SESSION['mod']);
}

if(!empty($_POST['mod']))
{
	$link = mysqli_connect("localhost","root","root","base_assiduite")
		or die('Impossible de se connecter à la base');
	if($stmt = mysqli_prepare($link, 'INSERT INTO module (intitule) VALUES (?)')){
		mysqli_stmt_bind_param($stmt, "s",$_POST['mod']);
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
<!DOCTYPE html>
<html>
<head>
	<title>Module</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/principal.css">
</head>

<body>
<header>
	<a href="deconnexion.php">Deconnexion</a>
</header>
<?php include("nav.php"); ?>
<main>
	<h2>Insertion Module</h2>
	<form method="POST" action="cible_module.php">
		<table>
		<tr><td><label>Nom module: </label></td><td><input type="text" name="mod"/></td>
		<tr><td colspan="2"><input type="submit" value="Envoyer"></td></tr>
		</table>
	</form>
</main>
</body>
</html>