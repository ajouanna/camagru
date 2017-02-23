<?PHP
$dir = '../superposables/*.{jpg,jpeg,gif,png}';

$files = glob($dir,GLOB_BRACE);
  
echo '<br /> <h3> Listing des images du repertoire superposables <h3> <br /> <br />';
foreach($files as $image)
{ 
	echo "<li><img class='vignette' src='$image' onclick='select_image(this)'></li>";
}
?>
