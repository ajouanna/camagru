<?php
// affichage de la page d'administration 
  session_start();

  require __DIR__ . '/../control/app_admin.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Camagru</title>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" href="/camagru/css/application.css" />
</head>
<?php
include('../view/header.php');
include('../view/content_admin.php');
include('../view/footer.php');
?>
<?php
footer();

?>
</html>