<?PHP
function setup($dbh)
{
	$sql = "CREATE DATABASE IF NOT EXISTS ".$dbh->getDbname();
	echo $sql.PHP_EOL;

	$result = $dbh->exec($sql); 

	$sql = "USE camagru";
	$result = $dbh->exec($sql); 

	$sql = "CREATE TABLE IF NOT EXISTS `User` ( 
			`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`name` varchar(8) NOT NULL, 
			`mail` varchar(255) NOT NULL, 
			`passwd` varchar(255) NOT NULL,
			`profile` ENUM('NORMAL', 'ADMIN') NOT NULL,
			`creation_date` datetime 
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
?>
