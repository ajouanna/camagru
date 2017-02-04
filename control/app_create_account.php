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
					$url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					// FIX THIS : il faut envoyer sur une autre page : la page de validation !
					$esc_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
					$message = "Veuillez cliquer sur le lien suivant pour confirmer votre inscription : ".$esc_url; 
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

$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
