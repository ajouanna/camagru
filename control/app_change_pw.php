<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/User.class.php';
require __DIR__ . '/../model/DBAccess.class.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['change_pw_login'])
	&& isset($_SESSION['change_pw_mail']) && isset($_SESSION['change_pw_cle'])
	&& isset($_POST['new_passwd']) && isset($_POST['new_new_passwd']) && isset($_POST['submit'])
	&& $_POST['submit'] ==='OK') 
{
	echo "DEBUG : ".$_SESSION['change_pw_login']."<br />";
	echo "DEBUG : ".$_SESSION['change_pw_mail']."<br />";
	echo "DEBUG : ".$_SESSION['change_pw_cle']."<br />";
	echo "DEBUG : ".$_POST['new_passwd']."<br />";
	echo "DEBUG : ".$_POST['new_new_passwd']."<br />";
	$data = array(
					'login' => $_SESSION['change_pw_login'],
					'mail' => $_SESSION['change_pw_mail'],
				);
	$user = new User($data);
	$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
	if (!$user->getDb($db->db))
	{
		echo "Erreur : utilisateur inconnu";
	}
	else
	{
		if ($user->cle !== $_SESSION['change_pw_cle'])
			echo "Erreur : cle erronee";
		else
		{
			$new_passwd = $_POST['new_passwd'];
			$new_new_passwd = $_POST['new_new_passwd'];
			if (empty($new_passwd) || empty ($new_new_passwd) || $new_passwd !== $new_new_passwd)
			{
				echo "Erreur de saisie : les deux saisies sont differentes ou vides !";
			}
			else
			{
				$user->passwd = hash('whirlpool',$new_passwd);
				$user->setPasswdByLoginMail($db->db);
				echo "DEBUG : user mis a jour";
				// A FINIR : faire un unset sur $_SESSION['change_pw_login'] etc. et retourner a  index.php
			}
		}
	}
}
else
	echo "DEBUG : En attente de saisie du formulaire";