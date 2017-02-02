<?php
session_start();
$_SESSION['logged_on_user'] = "";
unset($_SESSION['logged_on_user']);
$_SESSION['profil'] = 0;
unset($_SESSION['profil']);
header("Location: ../../index.php");
?>

