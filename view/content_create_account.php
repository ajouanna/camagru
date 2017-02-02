<form class="form" action="" method="post">
  <div class="form-group">
    <label for="login">Login :</label>
    <input type="text" class="form-control" name="login" size="8" maxlength="8">
  </div>

  <div class="form-group">
    <label for="mail">Mail :</label>
    <input type="email" class="form-control" name="mail" size="30">
  </div>

  <div class="form-group">
    <label for="passwd">Password:</label>
    <input type="password" class="form-control" name="passwd">
  </div>

  <button type="submit" value="submit" class="btn">Submit</button>
</form>
<?php echo  "Le nombre total d'utilisateurs est actuellement de " . $db->countAllUsers(); ?>
