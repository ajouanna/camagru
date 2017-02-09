<div class='logged_buttons'>

<button id="disconnect_button">Se déconnecter</button>
<button id="user_admin_button">Administrer son compte</button>
<button id="montage">Acceder au montage</button>
<button id="gallerie">Acceder à la gallerie</button>

<script>
var dbtn = document.getElementById("disconnect_button");
var admin = document.getElementById("user_admin_button");
var	montage = document.getElementById("montage");
var	gallerie = document.getElementById("gallerie");

dbtn.onclick = function() {
	window.location.pathname = 'camagru/control/logout.php';
}
admin.onclick = function() {
	window.location.pathname = 'camagru/view/admin_user.php';
}
montage.onclick = function() {
	window.location.pathname = 'camagru/view/montage.php';
}
gallerie.onclick = function() {
	window.location.pathname = 'camagru/view/gallerie.php';
}
</script>
</div>


