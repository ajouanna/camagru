<form class="form" action="" method="post">
<p>Saisissez les informations de votre compte</p>
  <div class="form-group">
    <label for="login">Login :</label>
    <input type="text" class="form-control" name="login" placeholder="*login" value="<?php if(isset($_POST['login'])) { echo htmlentities($_POST['login']);}?>" size="8" maxlength="8">
  </div>

  <div class="form-group">
    <label for="mail">Mail :</label>
    <input type="email" class="form-control" name="mail" placeholder="*mail" <?php if(isset($_POST['mail'])) { echo htmlentities($_POST['mail']);}?>size="30">
  </div>

  <div class="form-group">
    <label for="passwd">Mot de passe :</label>
    <input type="password" class="form-control" name="passwd" 
	pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
	title="Doit contenir 8 caractères minimum dont au moins 1 chiffre, une majuscule, une minuscule" 
	placeholder="*mdp" >
  </div>
  <div class="form-group">
	<label for="captcha">Recopiez le mot : "<?php echo captcha(); ?>"</label>
	<input type="text" name="captcha" id="captcha" />
  </div>			
  <button type="submit" value="submit" class="btn">Valider</button>
</form>
<?php echo  "Le nombre total d'utilisateurs du site est actuellement de " . $db->countAllUsers(); ?>
