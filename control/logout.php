<?php
/* ce script est appele pour deconnecter un utilisateur et revenir a la page d'accueil */
session_start();
$_SESSION['logged_on_user'] = "";
unset($_SESSION['logged_on_user']);
$_SESSION['profil'] = 0;
unset($_SESSION['profil']);
header("Location: ../index.php");
?>

