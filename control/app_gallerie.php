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

	$login = trim($_SESSION['logged_on_user']);

	$data = array('user_id' => $login);

	$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
	$image = new Image($data);

	$images_par_page=3;
	$nombre_images=$image->countPhotos($db->db);
	$nombre_pages=ceil($nombre_images/$images_par_page);
	echo 'Page : ';
	for ($i=1;$i<= $nombre_pages;$i++)
	{
		echo '<a href="gallerie.php?page=' . $i . '">' . $i . '</a> ';
	}
	if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']>0 && $_GET['page']<= $nombre_pages)
	{
			$page=intval($_GET['page']);
	}
	else
	{
			$page=1;
	}
	$position = $page * $images_par_page-$images_par_page;
	$result = $image->listBlockOfPhotos($db->db, $images_par_page, $position);

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
			echo "<button class='like_button' onclick='unlike(this,".$value['id'].")'>Je n'aime plus</button>";
		else
			echo "<button class='like_button' onclick='like(this,".$value['id'].")'>J'aime</button>";
		echo "<button class='like_button' onclick='add_comment(this,".$value['id'].")'>Ajouter un commentaire</button>";
		

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
	echo "</table>";
}

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
	if (!isset($_SESSION['logged_on_user']))
	{
		echo "ERREUR : acces interdit, veuillez vous logguer";
		exit;
	}
}