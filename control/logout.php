<?php
/* ce script est appele pour deconnecter un utilisateur et revenir a la page d'accueil */
if(!isset($_SESSION))
{
	session_start();
}
$_SESSION['logged_on_user'] = "";
unset($_SESSION['logged_on_user']);
$_SESSION['profile'] = "";
unset($_SESSION['profile']);
header("Location: ../index.php");
?>

