<form class="form" action="" method="post">
<p>Saisissez 2 fois votre nouveau mot de passe</p>
  <div class="form-group">
    <label for="new_passwd">Mdp:</label>
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

  <button type="submit" name='submit' value="OK" class="btn">Valider</button>
</form>
