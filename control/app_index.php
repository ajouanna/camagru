<?php
/* ce script traite la page d'accueil */
require __DIR__ . '/../config/database.php';
require __DIR__ . '/model/User.class.php';
require __DIR__ . '/model/DBAccess.class.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$login = trim($_POST['login']);
	$passwd = trim($_POST['passwd']);

	if (empty($login) || empty ($passwd))
	{
		echo "ERREUR : tous les champs doivent etre remplis !";
	}
	else
	{

		try 
		{
				$data = array(
					'login' => $login,
					'passwd' => $passwd,
				);
				$user = new User($data);
				$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
				if (!$user->checkCredentials($db->db))
				{
					echo "Erreur : login ou mdp errone";
				}
				else
				{
					echo "Utilisateur ".$login." loggue avec succes".PHP_EOL;
					$_SESSION['logged_on_user'] = $login;
					$_SESSION['status'] = "";
					$_SESSION['profile'] = "NORMAL"; // FIX THIS : prendre ce champ en bdd
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
