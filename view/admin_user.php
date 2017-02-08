<?php
// affichage de la page d'administration 
session_start();
require __DIR__ . '/../control/app_admin_user.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Camagru : administration utilisateur</title>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" href="/camagru/css/application.css" />
</head>
<div class="container">
<?php
include('../view/header.php');
include('../view/content_admin_user.php');
include('../view/footer.php');
?>
</div>
<?php
footer();
?>
</html>
