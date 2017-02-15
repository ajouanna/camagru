<?php
// affichage de la page d'administration 
session_start();
require __DIR__ . '/../control/app_admin_user.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Camagru : administration utilisateur</title>
<meta charset="UTF-8">
<meta name="description" content="Projet Camagru Ecole 42">
<meta name="keywords" content="HTML,CSS,PHP,JavaScript,MySql">
<meta name="author" content="Antoine Jouannais / Xavier Milleron">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" href="/camagru/css/application.css" />
</head>
<?php
include('../view/header.php');
include('../view/content_admin_user.php');
include('../view/footer.php');
?>
</html>
