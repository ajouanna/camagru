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
		$dir = '../data';
		$filename = $dir.$timestamp.'.png';
		$parts = explode(',', $image);
		$data = $parts[1];
		$data = base64_decode($data);

		file_put_contents($filename, $data);
		echo "DEBUG : A FAIRE ! mixer les images avec imagecopy";

		return;
	}
}
echo 'Erreur de PHP quelque part...';
return;
?>
