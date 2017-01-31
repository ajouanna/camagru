<?PHP
require_once("../MyPDO.php");
require_once('setup.php');
try {
	$pdo = new MyPDO("camagru.ini");
	setup($pdo);
} catch (PDOException $e) {
	print "Erreur : " . $e->getMessage() . PHP_EOL;
	die();
}

?>
