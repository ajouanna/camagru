<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/User.class.php';
require __DIR__ . '/../model/DBAccess.class.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$login = trim($_POST['login']);
	$mail = trim($_POST['mail']);
	$passwd = trim($_POST['passwd']);

	if (empty($login) || empty($mail) || empty ($passwd))
	{
		echo "ERREUR : tous les champs doivent etre remplis !";
	}
	else
	{

		try 
		{
			if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
			{
				echo "ERREUR : Formal d'email incorrect !";
			}
			else
			{
				$data = array(
					'login' => $login,
					'mail' => $mail,
					'passwd' => $passwd,
				);
				$user = new User($data);
				$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
				if (!$user->persist($db->db))
				{
					echo "Erreur : login ou mdp deja utilise";
				}
				else
				{
					$message = "Veuillez cliquer sur le lien suivant pour confirmer votre inscription : http://localhost:8080/camagru"; 
					mail($mail, 'Votre inscription a Camagru',$message);
					echo "Utilisateur ".$login." cree avec succes. Un mail vous a ete envoye, veuillez cliquer sur le lien qu'il contient pour vous authentifier".PHP_EOL;
				}
			}
		} catch (NestedValidationException $e) {
			echo "<ul>";
			foreach ($e->getMessages() as $message) {
				echo "<li>$message</li>";
			}
			echo "</ul>";
		}
	}

}

$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
