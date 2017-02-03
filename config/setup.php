<?PHP
require 'database.php';

function setup($dbh,$dbname)
{
	$sql = "CREATE DATABASE IF NOT EXISTS ".$dbname;
	$result = $dbh->exec($sql); 

	$sql = "USE ".$dbname;
	$result = $dbh->exec($sql); 

	$sql = "CREATE TABLE IF NOT EXISTS `User` ( 
/*			`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, */
			`login` varchar(8) NOT NULL, 
			`mail` varchar(255) NOT NULL, 
			`passwd` varchar(255) NOT NULL,
			`profile` ENUM('NORMAL', 'ADMIN') NOT NULL,
			`creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`status` ENUM('NOT_ACTIVATED', 'ACTIVATED') NOT NULL,
			PRIMARY KEY (login, mail)
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

	// creation de l'administrateur
	$sql = "INSERT INTO User (login, mail, passwd, profile, status) VALUES ('admin', 'ajouanna@hotmail.com', '2f9959b230a44678dd2dc29f037ba1159f233aa9ab183ce3a0678eaae002e5aa6f27f47144a1a4365116d3db1b58ec47896623b92d85cb2f191705daf11858b8', 'ADMIN', 'ACTIVATED')";
	$result = $dbh->exec($sql); 	
}

$dsn = "mysql:host=".$DB_HOST;
$db = new PDO(  $dsn,
                $DB_USER,
                $DB_PASSWORD
            );
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
setup($db,$DB_NAME);
echo 'setup completed'.PHP_EOL;
?>