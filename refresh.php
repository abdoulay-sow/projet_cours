<?php 
	session_start();
	echo $_POST['prenom_prof'];

	if(!empty($_POST['prenom_prof']))
	{
		$_SESSION['prenom'] = $_POST['prenom_prof'];
		$_SESSION['nom'] = $_POST['nom_prof'];

		$fichieractuel = $_SERVER['PHP_SELF'];

		if(!empty($_SERVER['QUERY_STRING']))
		{
			$fichieractuel .= '?'. $_SERVER['QUERY_STRING'];
		}
		echo '<br> la session prenom est'. $_SESSION['prenom']. 'et le post prenom est '. $_POST['prenom_prof'];
		header('location: '. $fichieractuel);
		exit;
		
	}
	echo $_POST['prenom_prof'];
	if(isset($_SESSION['prenom']) && isset($_SESSION['nom']))
	{
		$_POST['prenom_prof'] = $_SESSION['prenom'];
		$_POST['nom_prof'] = $_SESSION['nom'];

		unset($_SESSION['prenom'], $_SESSION['nom']);
	}


?>