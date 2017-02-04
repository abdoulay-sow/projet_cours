<?php
	session_start();
	if(!empty($_POST['pseudo']) && !empty($_POST['pass'])){
	$_SESSION['log'] = $_POST['pseudo'];
	$_SESSION['pass'] = $_POST['pass'];
	$pseudo = $_POST['pseudo'];
	$password = $_POST['pass'];	
	$link = mysqli_connect("localhost","root","root","base_assiduite")
		or die('Impossible de se connecter à la base');
	if($req = mysqli_prepare($link, "SELECT membre, motdepasse FROM user WHERE membre = ? AND motdepasse = ?")){
		mysqli_stmt_bind_param($req, "ss", $pseudo, $password);
		mysqli_execute($req);
		mysqli_stmt_bind_result($req, $donne['membre'], $donne['motdepasse']);
		while(mysqli_stmt_fetch($req)){
			if($donne['membre'] != NULL && $donne['motdepasse'] != NULL){
				$s = 1;
				header("location: principal.php");
				mysqli_stmt_close($req);
			}
			
		}
	}
	else{echo "requete mal préparer";}
	mysqli_close($link);
}
$s = 0;	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/accueil.css">
</head>
<body>
	<form method="POST" action="">
	<p>
		<label for="pseudo">Login: </label><br>
		<input type="text" name="pseudo" id="pseudo" required><br>
		<label for="pass">Mot de passe: </label><br>
		<input type="password" name="pass" id="pass" required><br>
		<input type="submit" name="Se Connecter" id="boutton">
	</p>
	<?php if($s == 2){ echo "login ou mot de passe éroné";} ?>
	</form>
</body>
</html>