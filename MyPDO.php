<?php
class MyPDO extends PDO
{
	private $_dbname;

	function getDbname()
	{
		return $this->_dbname;
	}

	public function __construct($file = 'camagru.ini')
	{
		$try_again = false;

		if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');

		$dsn = $settings['database']['driver'] .  ':host=' . $settings['database']['host'] .
			((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
			';dbname=' . $settings['database']['schema'];
		$this->_dbname = $settings['database']['schema'];
		try {
			parent::__construct($dsn, $settings['database']['username'], $settings['database']['password']);
		}
		catch (PDOException $e)
		{
			echo "Erreur :  ".$e->getMessage().PHP_EOL;
			if ($e->getCode() === 1049)
			{
				$try_again = true;
			}
			else
			{
				echo "Abandon du script...".PHP_EOL;
				die();
			}
		}
		if ($try_again)
		{
			echo "Nouvelle tentative".PHP_EOL;
			$dsn = $settings['database']['driver'] .  ':host=' . $settings['database']['host'] .
				((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '');
			try {
				parent::__construct($dsn, $settings['database']['username'], $settings['database']['password']);
			}
			catch (PDOException $e)
			{
				echo "Erreur :  ".$e->getMessage().PHP_EOL;
				die();
			}
			$sql = "CREATE DATABASE IF NOT EXISTS ".$this->_dbname;
			$result = $this->exec($sql); 

			$sql = "USE camagru";
			$result = $this->exec($sql); 

		}
		echo "Connexion resussie !".PHP_EOL;
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}
?>
