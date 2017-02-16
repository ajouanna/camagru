<?PHP
echo "Work in progress";


if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
	if (!isset($_SESSION['logged_on_user']))
	{
		echo "ERREUR : acces interdit, veuillez vous logguer";
		exit;
	}
}