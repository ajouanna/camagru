<div class='login'>

<!-- Trigger/Open The Modal -->
<button id="connect_button">Se connecter</button>

<!-- The Modal -->
<div id="loginModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
	<span id="login_close" class="close">&times;</span>
	<button id="create_user_button">On ne se connaît pas ? Créer un compte !</button>

	<form class="form" action="" method="post">
		<p>Tapez votre login et mot de passe</p>
  		<div class="form-group">
		<label for="login">Login :</label>
		<input type="text" class="form-control" name="login" size="8" maxlength="8">
  		</div>

		 <div class="form-group">
		<label for="passwd">Mot de passe:</label>
		<input type="password" class="form-control" name="passwd">
  		</div>
  		<button type="submit" name="submit" value="submit" class="btn">Valider</button>
		</form>  
	<button id="forgotten_passwd_button">Mot de passe oublié ?</button>
	</div>
</div>
<!-- MODALE POUR LE MDP OUBLIE -->
<div id="forgotPasswdModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
	<span id="fpw_close" class="close">&times;</span>
	<form class="form" action="" method="post">
		<p>Tapez votre email pour renouveller votre mot de passe</p>
		<div class="form-group">
		<label for="mail">mail:</label>
		<input type="email" class="form-control" name="mail" placeholder="*mail">
  		</div>
  		<button type="submit" name="submitFp" value="submitFp" class="btn">Valider</button>
		</form>  
	</div>
</div>
<script>
// Get the modal
var modal = document.getElementById('loginModal');
// modal.style.display = "none"; // par defaut, cacher

// Get the button that opens the modal
var btn = document.getElementById("connect_button");

// Get the <span> element that closes the modal
var span = document.getElementById("login_close");
var span1 = document.getElementById("fpw_close");


// bouton pour passer sur la creation
var create_button = document.getElementById("create_user_button");

// bouton pour mdp oublie
var forgotten_passwd_button = document.getElementById("forgotten_passwd_button");

var forgotPasswdModal = document.getElementById('forgotPasswdModal');

// When the user clicks the button, open the modal 
btn.onclick = function() {
	btn.style.display = "none";
	modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	btn.style.display = "initial";
	modal.style.display = "none";
}

span1.onclick = function() {
	btn.style.display = "initial";
	modal.style.display = "none";
	forgotPasswdModal.style.display = "none";
}


// si on clique sur le bouton de creation, enchainer sur la bonne page
create_button.onclick = function() {
	modal.style.display = "none"; // fermer fenetre modale
	window.location.pathname = 'camagru/view/create_account.php';
}

// si je clique sur mdp oublie
forgotten_passwd_button.onclick = function() {
	btn.style.display = "none";
	modal.style.display = "none"; // fermer fenetre modale
	forgotPasswdModal.style.display = "block";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
		btn.style.display = "initial";
	}
	
	if (event.target == forgotPasswdModal) {
		forgotPasswdModal.style.display = "none";
		btn.style.display = "initial";
	} 
}
</script>
</div>


