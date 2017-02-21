<?PHP
if(!isset($_SESSION))
{
	session_start();
}
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/Image.class.php';
require __DIR__ . '/../model/DBAccess.class.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$image_name = $_POST['image_name'];
	$login = $_SESSION['logged_on_user'];
	if (empty($image_name))
	{
		echo "ERREUR : le champ image_name doit etre rempli !";
		return;
	}
	else if (empty($login))
	{
		echo "ERREUR : pas d'utilisateur connecté";
	}
	else
	{
		$dir = $_SERVER['DOCUMENT_ROOT'].'/camagru/data/';
		$file = basename($image_name); // recupere ne nom de fichier dans le path complet; attention, verifier que ca marche sous windows 
		$filename = $dir.$file;
		$data = array(
					'user_id' => $login,
					'image_name' => $file
		);
		$image = new Image($data);
		$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
		if (!$image->delete($db->db))
			echo "ERREUR : probleme de suppression en base";
		if (!unlink($filename))
			echo "ERREUR : probleme de suppression de fichier";
		return;
	}
}
echo 'Erreur de PHP quelque part...';
return;
?>
