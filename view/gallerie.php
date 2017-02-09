<?php
// affichage de la page d'administration 
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Camagru : montage</title>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" href="/camagru/css/application.css" />
</head>
<?php
require __DIR__ . '/../control/app_gallerie.php';
include('../view/header.php');
include('../view/content_gallerie.php');
include('../view/footer.php');
?>
</html>