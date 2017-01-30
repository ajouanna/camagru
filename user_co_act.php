<?php session_start(); include('header.php'); ?>
	
<center>
		<form  class="auth" method = "post" action = "user_co.php" > 
			Identifiant : 
			<input type = "text" name = "login"/><br /><br />
			Mot de passe :
			<input type = "password" name = "passwd"/><br /><br />
			<input type = "submit" name = "submit" value = "submit"/>
		</form>
</center>