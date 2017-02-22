<?php
// suppression d'un user fait par un administrateur

require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/User.class.php';
require __DIR__ . '/../model/DBAccess.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['user']))
	{
		$login = $_POST['user'];
		if (empty($login))
		{
			echo "ERREUR : user invalide !";
		}
		else
		{
			$data = array('login' => $login);
			$user = new User($data);
			$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
			if (!$user->deleteUser($db->db))
			{
				echo "Erreur : suppression";
			}
			else
			{
				echo "Suppression du compte confirmée";
			}
		}
	}
}
