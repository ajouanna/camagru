<?PHP
require 'database.php';

function setup($dbh,$dbname)
{
	$sql = "CREATE DATABASE IF NOT EXISTS ".$dbname;
	$result = $dbh->exec($sql); 

	$sql = "USE ".$dbname;
	$result = $dbh->exec($sql); 

	$sql = "CREATE TABLE IF NOT EXISTS `User` ( 
			`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`login` varchar(8) NOT NULL, 
			`mail` varchar(255) NOT NULL, 
			`passwd` varchar(255) NOT NULL,
			`profile` ENUM('NORMAL', 'ADMIN') NOT NULL,
			`creation_date` datetime,
			`status` ENUM('NOT_ACTIVATED', 'ACTIVATED') NOT NULL
		) ";
	$result = $dbh->exec($sql); 

	$sql = "CREATE TABLE IF NOT EXISTS `Image` ( 
			`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`user_id` INT NOT NULL, 
			`image_name` varchar(255) NOT NULL, 
			`data` binary  NOT NULL, 
			`creation_date` datetime 
		)";
	$result = $dbh->exec($sql); 

	$sql = "CREATE TABLE IF NOT EXISTS `Comment` ( 
			`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`desc` varchar(255) NOT NULL, 
			`image_id` INT NOT NULL, 
			`liker_id` INT NOT NULL, 
			`creation_date` datetime 
		)";
	$result = $dbh->exec($sql); 

	$sql = "CREATE TABLE IF NOT EXISTS `Like` ( 
			`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`image_id` INT NOT NULL, 
			`liker_id` INT NOT NULL, 
			`creation_date` datetime 
		)";
	$result = $dbh->exec($sql); 
}

$dsn = "mysql:host=".$DB_HOST;
$db = new PDO(  $dsn,
                $DB_USER,
                $DB_PASSWORD
            );
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
setup($db,$DB_NAME);

?>