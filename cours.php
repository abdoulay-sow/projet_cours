<?php session_start();
if(isset($_SESSION['cprof']) && isset($_SESSION['cetudiant']) && isset($_SESSION['cmodule']))
{
	$_POST['id_dprof'] = $_SESSION['cprof'];
	$_POST['id_detudiant'] = $_SESSION['cetudiant'];
	$_POST['id_dmodule'] = $_SESSION['cmodule'];
	$_POST['ladate'] = $_SESSION['cdate'];
	$_POST['hdebut'] = $_SESSION['chdebut'];
	$_POST['hfin'] = $_SESSION['chfin'];
	unset($_SESSION['cprof'], $_SESSION['cetudiant'], $_SESSION['cmodule'],$_SESSION['chdebut'],$_SESSION['chfin']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cours</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/principal.css">
</head>
<body>
<header>
	<a href="deconnexion.php">Deconnexion</a>
</header>
<?php include("nav.php") ?>
<main>
<h2>Insertion Cours</h2>
<form method="POST" action="cible_cours.php">
<table><tr>
<td><label>Id professeur : </label></td><td><input type="number" name="id_dprof" required></td></tr>
<tr><td><label>Id étudiant : </label></td><td><input type="number" name="id_detudiant" required></td></tr>
<tr><td><label>Id module : </label></td><td><input type="number" name="id_dmodule" required></td></tr>
<tr><td><label>Date: </label></td><td><input type="date" name="ladate" required placeholder="Ex: aaaa-mm-jj"></td></tr>
<tr><td><label>Heure Début: </label></td><td><input type="time" name="hdebut" required placeholder="Ex: hh:mm:ss"></td></tr>
<tr><td><label>Heure Fin: </label></td><td><input type="time" name="hfin" required placeholder="Ex: hh:mm:ss"></td></tr>
<tr><td colspan="2"><input type="submit" name="Envoyer"></td></tr>
</table>
</form>
</main>
<?php
if(!empty($_POST['id_dprof']) && !empty($_POST['id_detudiant']) && !empty($_POST['id_dmodule']))
{	
	$link = mysqli_connect('localhost','root','root','base_assiduite')
		or die("Impossible de se connecter à la base");
	if ($req = mysqli_prepare($link, "INSERT INTO cours (matricule, num_etudiant, id_module, daate, h_debut, h_fin) VALUES (?, ?, ?, ?, ?, ?)"))
	{
		mysqli_stmt_bind_param($req,'iiisss',$_POST['id_dprof'],$_POST['id_detudiant'],$_POST['id_dmodule'],$_POST['ladate'],$_POST['hdebut'],$_POST['hfin']);
		mysqli_stmt_execute($req);
		mysqli_stmt_close($req);
	}
	mysqli_close($link);
}
?>


</body>
</html>