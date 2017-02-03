<?PHP

function user_logged()
{
	echo "<div class=\"user_logged\">Bonjour <b>".$_SESSION['logged_on_user']."</b></div>\n";
	require("logout_button.php");
	// echo "<br/><a href=\"/camagru/control/logout.php\">Se d&eacute;connecter</a>";
	// echo "<br/><a href=\"./user_account.php\">Mon compte</a>";
}

function user_notlogged()
{
	require('login.php');
}

function admin_page()
{
	echo "<div>";
	echo "<a class=\"admin_page\" href=\"./admin.php\">Admin</a>";
	echo "</div>";
}

function print_user_auth()
{
	if (!isset($_SESSION['logged_on_user']) || $_SESSION['logged_on_user'] === "")
		user_notlogged();
	else
		user_logged();
	if ($_SESSION['profil'] === "admin")
		admin_page();
}

function print_status()
{
	if ($_SESSION['status'] !== "")
		echo $_SESSION['status'];
}
?>

<html>
<head>
<title>Camagru</title>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" href="css/application.css" />
</head>
</html>
<body>
  <header>
	<div>
	  <h1>Bienvenus sur le site Camagru</h1>
	</div>
	<div class="header">
		<div class="logo">
		<a href="/camagru/index.php">
			<img class="logo_img" src="/camagru/img/madeinfrance.jpg" alt="Camagru" title="Camagru"/>
		</a>
		</div>
		<div class="header_right">
			<div class="user_auth">
				<?php print_user_auth(); ?>
			</div>
			<div class="status">
				<?php print_status(); ?>
			</div>
		</div>
	</header>

