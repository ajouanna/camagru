<?PHP

/* permet d'afficher toutes les images finalisees*/
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/User.class.php';
require __DIR__ . '/../model/Image.class.php';
require __DIR__ . '/../model/Like.class.php';
require __DIR__ . '/../model/comment.class.php';
require __DIR__ . '/../model/DBAccess.class.php';


function affiche_gallerie()
{
echo "<p>Liste des photos</p>";
	require __DIR__ . '/../config/database.php';

	$login = $_SESSION['logged_on_user'];

	$data = array('user_id' => $login);

	$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
	$image = new Image($data);

	$result = $image->listPhotos($db->db);

	echo "<table><tr><th>Photo</th><th>Nom utilisateur</th><th>Likes</th><th>Commentaires</th></tr>";

	foreach ($result as $value) 
	{
		echo "<tr>";
		echo "<td><img class='vignette' src='/camagru/data/".$value['image_name']."' alt='texte alternatif' /></td>";
		echo "<td>".$value['user_id']."</td>";
		echo "<td>".$value['likes']."</td>";
		echo "<td>".$value['comments']."</td>";
		echo "</tr>";
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
	if (!isset($_SESSION['logged_on_user']))
	{
		echo "ERREUR : acces interdit, veuillez vous logguer";
		exit;
	}
}