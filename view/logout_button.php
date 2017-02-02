<div class='logout_and_admin'>

<button id="disconnect_button">Se deconnecter</button>
<button id="admin_button">Administrer son compte</button>


<script>
var dbtn = document.getElementById("disconnect_button");
var admin = document.getElementById("admin_button");
dbtn.onclick = function() {
	window.location.pathname = 'camagru/control/logout.php';
}
admin.onclick = function() {
	window.location.pathname = 'camagru/view/admin_user.php';
}
</script>
</div>


