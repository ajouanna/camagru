<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
	<title>Projet Camagru</title>
</head>
<body>
<header>
<?php
//session_start();
?>
	<ul>
		<li><a class="active" href="accueil.php">Accueil</a></li>
         <?php
            if (!$_SESSION["login"]) {echo "<li><a href=\"auth_act.php\">S'inscrire</a></li>";}
        ?>
        <li><a href=
        <?php
            if ($_SESSION["login"]) {echo "\"Deco.php\">Deconnection";}
            else {echo "\"user_co_act.php\">Se connecter";}
            echo "</a></li>";
        ?>
         <?php
            if ($_SESSION["login"] == "admin" || $_SESSION["admin"] == TRUE) {echo "<li><a href=\"admin_act.php\">Admin";}
            echo "</a></li>";
        ?>
	</ul>
</header>