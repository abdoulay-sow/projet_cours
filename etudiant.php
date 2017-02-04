<?php session_start();
if(isset($_SESSION['prenom_et']) && isset($_SESSION['nom_et']) && isset($_SESSION['sexe_et']) && isset($_SESSION['grade_et']) &&isset($_SESSION['niveau_et']) && isset($_SESSION['filiere_et']))
{
	$_POST['prenom_et'] = $_SESSION['prenom_et'];
	$_POST['nom_et'] = $_SESSION['nom_et'];
	$_POST['sexe_et'] = $_SESSION['sexe_et'];
	$_POST['grade_et'] = $_SESSION['grade_et'];
	$_POST['niveau_et'] = $_SESSION['niveau_et'];
	$_POST['filiere_et'] = $_SESSION['filiere_et'];

	unset($_SESSION['prenom_et'], $_SESSION['nom_et'], $_SESSION['sexe_et'], $_SESSION['grade_et'], $_SESSION['niveau_et'], $_SESSION['filiere_et']);
}
?>
<?php
if(!empty($_POST['prenom_et']) && !empty($_POST['nom_et']) && !empty($_POST['sexe_et']) && !empty($_POST['grade_et']) && !empty($_POST['niveau_et']) && !empty($_POST['filiere_et']))
{
	$link = mysqli_connect("localhost","root","root","base_assiduite")
		or die('Impossible de se connecter à la base');

	if($stmt = mysqli_prepare($link, 'INSERT INTO etudiant (prenom, nom, sexe, grade, niveau, filiere) VALUES(?, ?, ?, ?, ?, ?)'))
	{
		mysqli_stmt_bind_param($stmt, "ssssss",$_POST['prenom_et'],$_POST['nom_et'],$_POST['sexe_et'],$_POST['grade_et'],$_POST['niveau_et'],$_POST['filiere_et']);
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
	<title>Etudiant</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/principal.css">
</head>
<body>
<header>
	<a href="deconnexion.php">Deconnexion</a>
</header>
<?php include('nav.php') ?>
<main>
	<h2>Insertion Etudiant </h2>
	<form method="POST" action="cible_etudiant.php">
	<table>
		<tr>
			<td><label>Prénom: </label></td>
			<td><input type="text" name="prenom_et" required></td>
		</tr>
		<tr>
			<td><label>Nom: </label></td>
			<td><input type="text" name="nom_et" required></td>
		</tr>
		<tr>
			<td>Sexe:</td>
			<td><input type="radio" name="sexe_et" value="M" required><label>M</label><input type="radio" name="sexe_et" value="F" required><label>F</label></td>
		</tr>
		<tr>
			<td><label>Grade: </label></td>
			<td><input type="text" name="grade_et" required></td>
		</tr>
		<tr>
			<td><label>Niveau: </label></td>
			<td><input type="text" name="niveau_et" required></td>
		</tr>
		<tr>
			<td><label>Filière: </label></td>
			<td><input type="text" name="filiere_et" required></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Envoyer"></td>
		</tr>
		</table>
	</form>
</main>
</body>
</html>