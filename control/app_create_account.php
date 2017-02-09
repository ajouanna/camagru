<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/User.class.php';
require __DIR__ . '/../model/DBAccess.class.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$login = trim($_POST['login']);
	$mail = trim($_POST['mail']);
	$passwd = trim($_POST['passwd']);
	$captcha = trim($_POST['captcha']);
	if (empty($login) || empty($mail) || empty ($passwd) || empty($captcha))
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
			else if ($captcha !== $_SESSION['captcha'])
			{
				echo "ERREUR : captcha erroné";
			}
			else
			{
				$cle = md5(microtime(TRUE)*100000);

				$data = array(
					'login' => $login,
					'mail' => $mail,
					'passwd' => hash('whirlpool',$passwd),
					'cle' => $cle
				);
				$user = new User($data);
				$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
				if (!$user->persist($db->db))
				{
					echo "Erreur : login ou mdp deja utilise";
				}
				else
				{
					$url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".'?login='.urlencode($login).'&mail='.urlencode($mail).'&cle='.urlencode($cle);
					echo $url.PHP_EOL;
					// FIX THIS : il faut envoyer sur une autre page : la page de validation !
					//$esc_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
					//echo $esc_url.PHP_EOL;
					$message = "Veuillez cliquer sur le lien suivant pour confirmer votre inscription : ".$url;
					//echo $message.PHP_EOL; 
					mail($mail, 'Votre inscription a Camagru',$message);
?>
<script>
alert('Utilisateur cree avec succes! Un lien de validation va vous etre envoye par email');
window.location.pathname = '/camagru/index.php';
</script>
<?PHP
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
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	// j'arrive ici dans 2 cas : quand l'utilisateur a demandé la création
	// de son compte depuis la page index.php (dans ce cas il n'y a pas de parametres)
	// ou quand il a clique sur le lien de validation depuis le mail qu'il a recu
	// (dans ce cas il y a les parametres login, cle et mail)
	if (empty($_GET['login']) || empty($_GET['mail']) || empty ($_GET['cle']))
	{
		echo "DEBUG : les champs login, mail et cle doivent etre remplis !";
	}
	else
	{
		$login = trim($_GET['login']);
		$mail = trim($_GET['mail']);
		$cle = trim($_GET['cle']);
		// recuperer le user en bdd et verifier la cle (sauf si deja active)
		$data = array('login' => $login, 'mail' => $mail);
		$user = new User($data);
		$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
		if (!$user->getDb($db->db))
			echo 'Erreur : impossible de lire un User en bdd';
		else
		{
			if ($user->cle !== $cle)
			{
				echo "Erreur de cle !";
			}
			else
			{
				if ($user->status === 'ACTIVATED')
					echo "Erreur, utilisateur deja active";
				else
				{
					$user->status='ACTIVATED';
					$user->setDB($db->db);
					?>
<script>
alert('Utilisateur active avec succes!');
window.location.pathname = '/camagru/index.php';
</script>
<?PHP
				}
			}
		}
	}
}

$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
