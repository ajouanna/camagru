<div class='login'>

<!-- Trigger/Open The Modal -->
<button id="connect_button">Se connecter</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
	<span class="close">&times;</span>
<button id="create_user_button">On ne se connait pas ? Creer un compte !</button>

<form class="form" action="" method="post">
  <div class="form-group">
	<label for="login">Login :</label>
	<input type="text" class="form-control" name="login" size="8" maxlength="8">
  </div>

  <div class="form-group">
	<label for="passwd">Password:</label>
	<input type="password" class="form-control" name="passwd">
  </div>

  <button type="submit" value="submit" class="btn">Submit</button>
</form>  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');
// modal.style.display = "none"; // par defaut, cacher

// Get the button that opens the modal
var btn = document.getElementById("connect_button");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// bouton pour passer sur la creation
var create_button = document.getElementById("create_user_button");

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

// si on clique sur le bouton de creation, enchainer sur la bonne page
create_button.onclick = function() {
	var loc = window.location;
	modal.style.display = "none"; // fermer fenetre modale
	window.location.pathname = 'camagru/view/create_account.php';
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
		btn.style.display = "initial";
	}
}
</script>
</div>


