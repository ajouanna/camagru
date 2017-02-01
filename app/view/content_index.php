<div class='landing_page'>

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

// Get the button that opens the modal
var btn = document.getElementById("connect_button");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// bouton pour passer sur la creation
var create_button = document.getElementById("create_user_button");
console.log(create_button);
console.log(document.location);

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
   	console.log("ouverture fenetre modale");

}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	console.log("fermeture fenetre modale");
    modal.style.display = "none";
}

// si on clique sur le bouton de creation, enchainer sur la bonne page
create_button.onclick = function() {
	var loc = window.location;
	console.log(loc);
	window.location.pathname = 'camagru/create_account.php';
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<p>A FAIRE : </p>
<p>affcher un bouton de connexion et ouvrir une fenetre modale pour saisir</p>
<p>afficher le contenu de la page d'entree du site, par ex les photos les plus likees, en lecture seule<p>
</div>
