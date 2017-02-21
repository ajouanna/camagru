    <?PHP
session_start();

require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/Image.class.php';
require __DIR__ . '/../model/DBAccess.class.php';

function listPhotos()
{
	require __DIR__ . '/../config/database.php';
	$login = $_SESSION['logged_on_user'];

	$data = array(
		'user_id' => $login
	);

	$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
	$image = new Image($data);

	$result = $image->listPhotos($db->db);

	echo "<table><tr><th>Photo</th></tr>";

	foreach ($result as $value) 
	{
		echo "<tr>";
		echo "<td><img class='vignette' onclick='delete_image(this)' src='/camagru/data/".$value['image_name']."' alt='texte alternatif' /></td>";
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