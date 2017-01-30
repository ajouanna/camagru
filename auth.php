<?php include ('index.php');

	session_start();
	function error($str)
	{
		echo "$str\n";
		exit;
	}
	if ($_POST['submit'] == "Connexion" && !empty($_POST['id_user']) 
		&& !empty($_POST['nom']) && !empty($_POST['nom'])) {
		$largest_key = 0;
		$serialized_path = "private/";
		$serialized_file = $serialized_path . "passwd";
		if (file_exists($serialized_file))
		{
			$authentication = unserialize(file_get_contents($serialized_file));
			foreach ($authentication as $key => $element)
			{
				if ($element["login"] === $_POST["login"])
					error("Cet identifiant existe déjà !");
				if ($key > $largest_key)
					$largest_key = $key;
			}
		}
		$authentication[$largest_key + 1]["login"] = $_POST["login"];
		$authentication[$largest_key + 1]["passwd"] =  hash('whirlpool', $_POST["passwd"]);
		$authentication[$largest_key + 1]["admin"] = FALSE;
		@mkdir($serialized_path);
		file_put_contents($serialized_file, serialize($authentication));
		$_SESSION["login"] = $_POST["login"];
	}
	else
		error("Un des champs n'a pas été rempli");

	if ($_SESSION["login"] === $_POST["login"]) {
		echo "<center><h1>Tu es maintenant inscrit ! Super !</h1></center>";
		echo "<a href=\"accueil.php\"><img class = \"position : absolute; height :400px; width: 400px;margin-left:500px;\" src='ressources/logo.png'>";

	}
?>

