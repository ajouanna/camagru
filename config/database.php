<?PHP
require_once("../MyPDO.php");
require_once('setup.php');
try {
	$pdo = new MyPDO("camagru.ini");
	echo $pdo->getDbname().PHP_EOL;
	setup($pdo);
} catch (PDOException $e) {
	print "Erreur !: " . $e->getMessage() . "<br/>";
	die();
}

?>
