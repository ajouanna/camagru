<?php
// affichage de la page d'administration 
  session_start();

  require __DIR__ . '/../control/app_montage.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Camagru : montage</title>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" href="/camagru/css/application.css" />
</head>
<?php
include('../view/header.php');
include('../view/content_montage.php');
include('../view/footer.php');
?>
<?php
footer();

?>
</html>