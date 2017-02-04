<?php session_start();
	if(isset($_SESSION['matricule'], $_SESSION['numero'], $_SESSION['module'], $_SESSION['motif'], $_SESSION['heure'])){
		$_POST['matricule'] = $_SESSION['matricule'];
		$_POST['numero'] = $_SESSION['numero'];
		$_POST['module'] = $_SESSION['module'];
		$_POST['motif'] = $_SESSION['motif'];
		$_POST['heure'] = $_SESSION['heure'];

		unset($_SESSION['matricule'], $_SESSION['numero'], $_SESSION['module'], $_SESSION['motif'], $_SESSION['heure']);
	}
	
	if(isset($_SESSION['numero2']))
	{
		$_POST['numero2'] = $_SESSION['numero2'];

		unset($_SESSION['numero2']);
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Assiduite</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/principal.css">
</head>
<body>
<header><a href="deconnexion.php">Deconnexion</a></header>
<?php include("nav.php"); ?>
<main>
	<form method="POST" action="cible_assiduite.php">
		<table>
			<tr>
				<td><label>Matricule Professeur</label></td>
				<td><input type="number" name="matricule" required></td>
			</tr>
			<tr>
				<td><label>Numéro Etudiant</label></td>
				<td><input type="number" name="numero" required></td>
			</tr>
			<tr>
				<td><label>ID Module</label></td>
				<td><input type="number" name="module" required></td>
			</tr>
			<tr>
				<td><label>Motif</label></td>
				<td><input type="text" name="motif" required></td>
			</tr>
			<tr>
				<td><label>Heure Entré</label></td>
				<td><input type="time" name="heure" required></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" Value="Envoyer"></td>
			</tr>
		</table>
	</form>
	<hr>
	<form method="POST" action="cible_assiduite2.php">
		<label>Numéro Etudiant : </label><input type="number" name="numero2">
		<input type="submit" value="Envoyer">
	</form>
	
<?php 
if(!empty($_POST['numero2']))
		{
		?>
		<table style="border: 1px solid silver;" id="tbl">
	<tr>
		<th>Prenom Etudiant</th>
		<th>Nom Etudiant</th>
		<th>Motif</th>
		<th>Heure Entré</th>
		<th>Nom professeur</th>
	</tr>
		<?php
		$link = mysqli_connect("localhost","root","root","base_assiduite")
			or die("Impossible de se connecter à la base");
		if($req = mysqli_prepare($link, "SELECT e.prenom, e.nom, a.motif, a.h_entre,p.nom FROM etudiant as e INNER JOIN assiduite as a ON e.num_etudiant = a.num_etudiant INNER JOIN professeur as p ON a.matricule = p.matricule WHERE e.num_etudiant = ?"))
		{
			mysqli_stmt_bind_param($req, "i", $_POST['numero2']);
			mysqli_execute($req);
			mysqli_stmt_bind_result($req, $donne['e.prenom'], $donne['e.nom'], $donne['motif'], $donne['h_entre'], $donne['p.nom']);
			while(mysqli_stmt_fetch($req)){
	?>
	<tr>
		<td><?php echo $donne['e.prenom'];?></td>
		<td><?php echo $donne['e.nom'];?></td>
		<td><?php echo $donne['motif'];?></td>
		<td><?php echo $donne['h_entre'];?></td>
		<td><?php echo $donne['p.nom'];?></td>
	</tr>
	<?php
			}
			mysqli_stmt_close($req);
		}
		mysqli_close($link);
	} 
?>
	</table>
</main>
<?php  
	if(!empty($_POST['numero']) && !empty($_POST['matricule']) && !empty($_POST['module']) && !empty($_POST['motif']) && !empty($_POST['heure']))
	{
		$link = mysqli_connect("localhost","root","root","base_assiduite")
			or die("Impossible de se connecter à la base");
		if($req = mysqli_prepare($link, "INSERT INTO assiduite (matricule, num_etudiant, id_module, motif, h_entre) VALUES (?, ?, ?, ?, ?)"))
		{
			mysqli_stmt_bind_param($req, "iiiss", $_POST['matricule'], $_POST['numero'], $_POST['module'], $_POST['motif'], $_POST['heure']);
			mysqli_execute($req);
			mysqli_stmt_close($req);
		}
		mysqli_close($link);
	}
?>
</body>
</html>