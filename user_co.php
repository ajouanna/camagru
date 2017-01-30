<?php
	session_start();
	function error($str)
	{
		echo "$str\n";
		exit;
	}
	if ($_SESSION["login"] == $_POST["login"]) {
		// session_start();
		echo "<center><h1 style = \"font-size = 100px;\">Tu es deja connecte</h1></center>";
		echo "<a href=\"acceuil.php\"><img class = \"position : absolute; height :400px; width: 400px;margin-left:500px;\" src='ressources/logo.png'>";
		exit();
	}
	if ($_POST['submit'] == "submit" && !empty($_POST['passwd']) && !empty($_POST['login'])) {
		$serialized_path = "private/";
		$serialized_file = $serialized_path . "passwd";
		if (file_exists($serialized_file))
		{
		$authentication = unserialize(file_get_contents($serialized_file));
		foreach ($authentication as $key => $element)
		{
			if ($element["login"] == $_POST["login"]) {
				if($element["passwd"] == hash('whirlpool', $_POST["passwd"])) {
					if ($element["login"] == 'admin') {
						$_SESSION["admin"] = TRUE;
					}
					echo "<center><h1 style = \"font-size = 100px;\">BIENVENUE</h1></center>";
					echo "<a href=\"acceuil.php\"><img class = \"position : absolute; height :400px; width: 400px;margin-left:500px;\" src='ressources/logo.png'>";
					$_SESSION["login"] = $_POST["login"];
					break;
				}
			}
				else {
					echo "<center><h1 style = \"font-size = 100px;\">Tu n'es pas inscrit sur le site</h1></center>";
					echo "<a href=\"acceuil.php\"><img class = \"position : absolute; height :400px; width: 400px;margin-left:500px;\" src='ressources/logo.png'>";
				}
		}
	}
	}
	else
		error("Un des champs est vide");
?>