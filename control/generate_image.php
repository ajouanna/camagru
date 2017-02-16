<?PHP
session_start();
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/Image.class.php';
require __DIR__ . '/../model/DBAccess.class.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$image = $_POST['image'];
	$image_incrustee = $_POST['image_incrustee'];
	$login = $_SESSION['logged_on_user'];
	if (empty($image) || empty ($image_incrustee))
	{
		echo "ERREUR : les champs image et image_incrustee doivent etre remplis !";
		return;
	}
	else if (empty($login))
	{
		echo "ERREUR : pas d'utilisateur connecté";
	}
	else
	{
		$timestamp = mktime();
		$dir = $_SERVER['DOCUMENT_ROOT'].'/camagru/data/';
		$filename = $dir.$timestamp.'.png';
		$parts = explode(',', $image);
		$data = $parts[1];
		// remplacer les blancs par des + quand les donnees viennent de Javascript canvas.toDataURL() 
		$data = str_replace(' ','+',$data); 
		$data = base64_decode($data);

		file_put_contents($filename, $data); // ecriture de l'image de fond
		$dessous = imagecreatefrompng($filename); //on ouvre l'image de fond
		$dessus = imagecreatefrompng($image_incrustee); //on ouvre l'image a incruster
		$infosize_dessous = getimagesize($filename); // on recupere la taille de l'image de fond dans un array
		$infosize_dessus = getimagesize($image_incrustee); 
		$width_dessous = $infosize_dessous[0];
		$height_dessous = $infosize_dessous[1];
		$width_dessus = $infosize_dessus[0];
		$height_dessus = $infosize_dessus[1];

		$dst_x = 0;
		$dst_y = 0;
		$src_x = 0;
		$src_y = 0;
		$src_w = $width_dessus;
		$src_h = $height_dessus;
		$dst_w = $width_dessous;
		$dst_h = $height_dessous;
		$result = imagecopyresampled ($dessous, $dessus, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h );
		imagepng($dessous, $filename); // on ecrit l'image traitee vers le fichier $filename
		// on sauvegarde en base
		$data = array(
					'user_id' => $login,
					'image_name' => $filename
		);
		$image = new Image($data);
		$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
		if (!$image->persist($db->db))
			echo "ERREUR : probleme d'insertion en base";
		return;
	}
}
echo 'Erreur de PHP quelque part...';
return;
?>
