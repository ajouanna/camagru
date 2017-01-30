<?php
	session_start();
	$_SESSION["login"] = array();
	session_destroy();
	echo "<center><h1 style = \"font-size = 100px;\">A bientot !</h1></center>";
	echo "<a href=\"accueil.php\"><img class = \"position : absolute; height :100%; width: 100%;margin-left:500px;\" src='ressources/logo.png'>";
?>

