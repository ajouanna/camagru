<?PHP
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$image = $_POST['image'];
	$image_incrustee = $_POST['image_incrustee'];

	if (empty($image) || empty ($image_incrustee))
	{
		echo "ERREUR : les champs image et image_incrustee doivent etre remplis !";
		return;
	}
	else
	{
		$timestamp = mktime();
		$dir = '../data/';
		$filename = $dir.$timestamp.'.png';
		$parts = explode(',', $image);
		$data = $parts[1];
		$data = base64_decode($data);

		file_put_contents($filename, $data);
		$dessous = imagecreatefrompng($filename); //on ouvre l'image source
		$dessus = imagecreatefrompng($image_incrustee); //on ouvre l'image source
		$infosize = getimagesize($filename); // on recupere la taille dans un array
		$width_dessous = $infosize[0];
		$height_dessous = $infosize[1];
		$dst_x = 0;
		$dst_y = 0;
		$src_x = 0;
		$src_y = 0;
		$src_w = $width_dessous;
		$src_h = $height_dessous;
		$result = imagecopy ( $dessous, $dessus, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h );
		imagepng($dessous, $filename); // on ecrit l'image traitee $dest vers le fichier $file
	}
}
echo 'Erreur de PHP quelque part...';
return;
?>
