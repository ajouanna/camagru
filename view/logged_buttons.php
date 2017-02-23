<div class='logged_buttons'>

<button id="disconnect_button">Se déconnecter</button>
<?php
// le code ci-dessous affiche des boutons differents selon la page dans laquelle on est
if ($_SERVER['REQUEST_URI'] !== "/camagru/view/admin_user.php")
	echo '<button id="user_admin_button">Administrer son compte</button>';
if ($_SERVER['REQUEST_URI'] !== "/camagru/view/montage.php")
	echo '<button id="montage">Acceder au montage</button>';
if ($_SERVER['REQUEST_URI'] !== "/camagru/view/gallerie.php")
	echo '<button id="gallerie">Acceder à la galerie</button>';
?>

<script>
var dbtn = document.getElementById("disconnect_button");
var admin = document.getElementById("user_admin_button");
var	montage = document.getElementById("montage");
var	gallerie = document.getElementById("gallerie");

if (dbtn)
dbtn.onclick = function() {
	window.location.pathname = 'camagru/control/logout.php';
}
if (admin)
admin.onclick = function() {
	window.location.pathname = 'camagru/view/admin_user.php';
}
if (montage)
montage.onclick = function() {
	window.location.pathname = 'camagru/view/montage.php';
}
if (gallerie)
gallerie.onclick = function() {
	window.location.pathname = 'camagru/view/gallerie.php';
}
</script>
</div>


