<?PHP
session_start();
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/Comment.class.php';
require __DIR__ . '/../model/DBAccess.class.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$image_id = $_POST['image_id'];
	$comment = $_POST['comment'];
	$login = $_SESSION['logged_on_user'];
	if (empty($image_id) || empty($comment))
	{
		echo "ERREUR : les champs image_id et comment doivent etre remplis !";
		return;
	}
	else if (empty($login))
	{
		echo "ERREUR : pas d'utilisateur connecté";
	}
	else
	{
		$data = array(
					'liker_id' => $login,
					'image_id' => $image_id,
					'description' => $comment
		);
		$comment = new Comment($data);
		$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
		if (!$comment->persist($db->db))
			echo "ERREUR : probleme d'insertion en base";
		else
			echo "Insertion en base reussie";
		return;
	}
}
echo 'Erreur de PHP quelque part...';
return;
?>
