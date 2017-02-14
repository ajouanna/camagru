<?PHP
$dir = '../superposables/*.{jpg,jpeg,gif,png}';

$files = glob($dir,GLOB_BRACE);
  
echo 'Listing des images du repertoire superposables <br />';
foreach($files as $image)
{ 
	echo "<li><img class='vignette' src='$image' onclick='select_image(this)'></li>";
}
?>
