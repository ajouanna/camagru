<?PHP
$dir = '../superposables/*.{jpg,jpeg,gif,png}';

$files = glob($dir,GLOB_BRACE);
  
echo '<p id="texte"> Choisissez une image superposable dans cette liste<p>';
foreach($files as $image)
{ 
	echo "<li><img class='vignette' src='$image' onclick='select_image(this)'></li>";
}
?>
