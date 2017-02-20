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

	$result = $image->listAllPhotos($db->db);

	echo "<table><tr><th>Photo</th><th>Nom utilisateur</th><th>Nombre de likes</th></tr>";

	foreach ($result as $value) 
	{
		echo "<tr>";
		echo "<td><img class='image_gallerie' src='/camagru/data/".$value['image_name']."' alt='texte alternatif' /></td>";
		echo "<td>".$value['user_id']."</td>";
		echo "<td>";
		// lister tous les commentaires pour cette image
		$image->id = $value['id'];
		$nbre_likes = $image->likesPerPhoto($db->db);
		echo $nbre_likes;
		echo "</td>";
		echo "</tr>";
		echo "<tr><td>";
		$data = array(
					'image_id' => $value['id'],
					'liker_id' => $login
		);
		$like = new Like($data);
		if ($like->exists($db->db))
			echo "<button class='like_button' onclick='unlike(this)'>Je n'aime plus</button>";
		else
			echo "<button class='like_button' onclick='like(this)'>J'aime</button>";
		echo "<button>Ajouter un commentaire</button>";
		echo "</td></tr>";
		echo "<tr><td>";
		$data = array(
					'image_id' => $value['id']
		);
		$comment = new Comment($data);
		$resultComment = $comment->listByimage($db->db);
		foreach ($resultComment as $val) {
			echo "<li>".$val['liker_id']." : ".$val['description']."</li>";
		}
		echo "</td></tr>";
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