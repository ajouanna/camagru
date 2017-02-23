<div class="page_content">
	<h2>Page d'administration utilisateur</h2>

	<button id="change_pw_button">Changer son mot de passe</button>
	<button id="suppress_account_button">Supprimer son compte</button>

	<div id="change_pw_modal" class="modal">
		<div class="modal-content">
			<span id="change_pw_close" class="close">&times;</span>
			<form class="form" action="" method="post">
				<p>Changement de mot de passe</p>
				<div class="form-group">
				<label for="current_pw">Mot de passe actuel :</label>
				<input type="password" class="form-control" name="current_pw">
				</div>
			<div class="form-group">
				<label for="new_passwd">Nouveau mdp:</label>
				<input type="password" class="form-control" name="new_passwd" placeholder="*mdp" 
				pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
				title="Doit contenir 8 caractères minimum dont au moins 1 chiffre, une majuscule, une minuscule" 
				required>
			</div>
			<div class="form-group">
				<label for="new_new_passwd">Confirmez:</label>
				<input type="password" class="form-control" name="new_new_passwd" placeholder="*mdp" 
				pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
				title="Doit contenir 8 caractères minimum dont au moins 1 chiffre, une majuscule, une minuscule" 
				required>
			</div>
  			<button type="submit" name="submit" value="submit" class="btn">Valider</button>
			</form>
		</div>
	</div>

		<div id="suppress_user_modal" class="modal">
		<div class="modal-content">
			<span id="suppress_user_close" class="close">&times;</span>
			<form class="form" action="" method="post">
				<p>Suppression de l'utilisateur</p>
  				<button type="submit" name="suppress" value="suppress" class="btn">Cliquez ici pour valider la suppression définitive de votre compte</button>
			</form>
		</div>
	</div>
	<script type="text/javascript">
	// Get the modal
	var modal = document.getElementById('change_pw_modal');
	// modal.style.display = "none"; // par defaut, cacher

	// Get the button that opens the modal
	var btn = document.getElementById("change_pw_button");

	// Get the <span> element that closes the modal
	var span = document.getElementById("change_pw_close");
	var span2 = document.getElementById("suppress_user_close");

	var suppress_account_button = document.getElementById("suppress_account_button");
	var modal2 = document.getElementById('suppress_user_modal');


	// When the user clicks the button, open the modal 
	btn.onclick = function() {
		btn.style.display = "none";
		modal.style.display = "block";
	}

	suppress_account_button.onclick = function() {
		suppress_account_button.style.display = "none";
		modal2.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		btn.style.display = "initial";
		modal.style.display = "none";
	}

	span2.onclick = function() {
		suppress_account_button.style.display = "initial";
		modal2.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
			btn.style.display = "initial";
		}
		if (event.target == modal2) {
			modal2.style.display = "none";
			suppress_account_button.style.display = "initial";
		}
	}
	</script>

</div>
