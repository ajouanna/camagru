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
		imagepng($dessous, $filename); // on ecrit l'image traitee $dest vers le fichier $file
		return;
	}
}
echo 'Erreur de PHP quelque part...';
return;
?>
