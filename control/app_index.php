<?php
/* ce script traite la page d'accueil */
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/User.class.php';
require __DIR__ . '/../model/Image.class.php';
require __DIR__ . '/../model/Comment.class.php';
require __DIR__ . '/../model/DBAccess.class.php';

function list_best_photos()
{
	require __DIR__ . '/../config/database.php';

	echo "<h2>Les photos les plus likées du moment</h2>";
	$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
	$image = new Image();

	$result = $image->listBestPhotos($db->db);

	echo "<table><tr><th>Photo</th><th>Nom utilisateur</th><th>Likes</th><th>Commentaires</th></tr>";

	foreach ($result as $value) 
	{
		echo "<tr>";
		echo "<td><img class='image_gallerie' src='/camagru/data/".$value['image_name']."' alt='texte alternatif' /></td>";
		echo "<td>".$value['user_id']."</td>";
		echo "<td>".$value['likes']."</td>";
		echo "<td>";
		// lister tous les commentaires pour cette image
		$data = array(
					'image_id' => $value['id']
		);
		$comment = new Comment($data);
		$resultComment = $comment->listByimage($db->db);
		foreach ($resultComment as $val) {
			echo "<li>".$val['liker_id']." : ".$val['description']."</li>";
		}
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['submit']))
	{
		$login = trim($_POST['login']);
		$passwd = trim($_POST['passwd']);

		if (empty($login) || empty ($passwd))
		{
			echo "ERREUR : tous les champs doivent être remplis !";
		}
		else
		{

			try 
			{
				$data = array(
					'login' => $login,
					'passwd' => hash('whirlpool',$passwd)
				);
				$user = new User($data);
				$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
				if (!$user->checkCredentials($db->db))
				{
					echo "Erreur : login ou mdp erroné";
				}
				else
				{	
					if ($user->status !== 'ACTIVATED')
					{
						echo "Erreur : veuillez vous activer avant de vous connecter !";
					}
					else
					{
						// TBD : si l'utilisateur n'est pas confirme, le lui dire et ne pas accepter la connexion
						echo "Utilisateur ".$login." loggue avec succes".PHP_EOL;
						$_SESSION['logged_on_user'] = $login;
						$_SESSION['status'] = "";
						$_SESSION['profile'] = $user->profile;
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
	else if (isset($_POST['submitFp']))
	{
		$mail = trim($_POST['mail']);
		if (empty($mail))
		{
			echo "ERREUR : le champ mail doit être rempli !";
		}
		else
		{
			// renvoyer un lien pour resaisir le mdp
			$data = array('mail' => $mail);
			$user = new User($data);
			$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
			if (!$user->getUserByMail($db->db))
			{
				echo "Erreur : mail inconnu";
			}
			else
			{
				$login = $user->login;
				$cle = $user->cle;
				$url="http://$_SERVER[HTTP_HOST]/camagru/control/app_forgot_pw.php".'?login='.urlencode($login).'&mail='.urlencode($mail).'&cle='.urlencode($cle);

					$message = "Veuillez cliquer sur le lien suivant pour modifier votre mot de passe : ".$url;
					mail($mail, 'Votre demande de changement de mot de passe a Camagru',$message);
					echo "Demande de changement de mot de passe prise en compte, consultez votre boite mail";
			}
		}
	}
}
else if ($_SERVER['REQUEST_METHOD'] === 'GET')
{

}

$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
