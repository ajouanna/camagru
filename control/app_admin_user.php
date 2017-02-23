<?php
// traitement de la page d'administration : suppression d'un utilisateur

require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/User.class.php';
require __DIR__ . '/../model/DBAccess.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['submit']))
	{
		$current_pw = trim($_POST['current_pw']);
		$new_passwd = trim($_POST['new_passwd']);
		$new_new_passwd = trim($_POST['new_new_passwd']);
		$login = $_SESSION['logged_on_user'];

		if (empty($current_pw) || empty ($new_passwd) || empty ($new_new_passwd))
		{
			echo "ERREUR : tous les champs doivent être remplis !";
		}
		else if ($new_passwd !== $new_new_passwd)
			echo "ERREUR : les deux valeurs du nouveau mot de passe sont différentes";
		else if (empty($login))
			echo "ERREUR : pas d'utilisateur loggué";
		else
		{
			try 
			{
				$data = array(
					'login' => $login,
					'passwd' => hash('whirlpool',$current_pw)
				);
				$user = new User($data);
				$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
				if (!$user->checkCredentials($db->db))
				{
					echo "Erreur : mot de passe actuel erroné";
				}
				else
				{	
					$user->passwd = hash('whirlpool',$new_passwd);
					$user->setPasswdByLogin($db->db);
					echo "Mot de passe mis a jour";
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
	else if (isset($_POST['suppress']))
	{
		$login = $_SESSION['logged_on_user'];
		$profile = $_SESSION['profile'];
		if (!empty($profile) && $profile === "ADMIN")
		{
			echo "ERREUR : un administrateur ne peux pas supprimer son propre compte!";
		}
		else if (empty($login))
		{
			echo "ERREUR : pas d'utilisateur loggué !";
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
				header('location:../control/logout.php');
				echo "Suppression du compte confirmée";
			}
		}
	}
}
