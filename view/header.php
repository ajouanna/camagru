<?PHP

function user_logged()
{
	echo "<div class=\"user_logged\">Bonjour <b>".$_SESSION['logged_on_user']."</b></div>\n";
	require("logged_buttons.php");
}

function user_notlogged()
{
	require('login.php');
}

function admin_page()
{
	require('admin_page_button.php');
}

function print_user_auth()
{
	if (!isset($_SESSION['logged_on_user']) || $_SESSION['logged_on_user'] === "")
		user_notlogged();
	else
		user_logged();
	if (isset($_SESSION['profile']) && $_SESSION['profile'] === "ADMIN")
		admin_page();
}

function print_status()
{
	if (!empty($_SESSION['status']))
		echo $_SESSION['status'];
}
?>


<body>
  <header>
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

