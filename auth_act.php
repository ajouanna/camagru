<?php include('header.php');
session_start();
 ?>
<div class="box"> 
<center>
	<form class="auth" method = "post" action = "auth.php" > 
		Identifiant :     
		<input type = "text" name = "id_user"/><br /><br />
		Nom :     
		<input type = "text" name = "name"/><br /><br />
		Mot de passe :
		<input type = "password" name = "passwd"/><br /><br />
		<input type = "submit" name = "submit" value = "Connexion"/>
	</form>
</center>
</div>
