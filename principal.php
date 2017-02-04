<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Principal</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/principal.css">
</head>
<body>
<header>
<a href="deconnexion.php">Deconnexion</a>
</header>
<?php include('nav.php') ?>
<main>
	<?php echo 'Bienvenue '.$_SESSION['log']; ?>
</main>
</body>
</html>