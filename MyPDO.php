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
		if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');

		print_r($settings);

		$dsn = $settings['database']['driver'] .
			':host=' . $settings['database']['host'] .
			((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
			';dbname=' . $settings['database']['schema'];

		parent::__construct($dsn, $settings['database']['username'], $settings['database']['password']);
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->_dbname = $settings['database']['schema'];
	}
}
?>
