<?php
require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../model/User.class.php';
require __DIR__ . '/../model/DBAccess.class.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$login = trim($_POST['login']);
	$mail = trim($_POST['mail']);
	$passwd = trim($_POST['passwd']);


	try 
	{
		// A FAIRE : valider les donnees
		/*
		$depart_validator->assert($depart_date);
		$return_validator->assert($return_date);
		$email_validator->assert($email);
		$reason_validator->assert($reason);
		 */
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
			echo "Formal d'email incorrect !";
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
		}
	} catch (NestedValidationException $e) {
		echo "<ul>";
		foreach ($e->getMessages() as $message) {
			echo "<li>$message</li>";
		}
		echo "</ul>";
	}
}

$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
