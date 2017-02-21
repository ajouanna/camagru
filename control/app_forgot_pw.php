<?php
if(!isset($_SESSION))
{
	session_start();
}
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/User.class.php';
require __DIR__ . '/../model/DBAccess.class.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	// si je suis dans un GET , c'est pour changer de mdp
	$login = trim($_GET['login']);
	$mail = trim($_GET['mail']);
	$cle = trim($_GET['cle']);
	if (empty($login) || empty($mail) || empty ($cle))
	{
		echo "ERREUR : les champs login, mail et cle doivent etre remplis !";
	}
	else
	{
		// recuperer le user en bdd et verifier la cle (sauf si deja active)
		$data = array('login' => $login, 'mail' => $mail);
		$user = new User($data);
		$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
		if (!$user->getDb($db->db))
			echo 'Erreur : impossible de lire un User en bdd';
		else
		{
			$_SESSION['change_pw_login']=$login;
			$_SESSION['change_pw_mail']=$mail;
			$_SESSION['change_pw_cle']=$cle;
?>
<script>
window.location.pathname = '/camagru/view/change_pw.php';
</script>
<?PHP
		}
	}
}

$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
