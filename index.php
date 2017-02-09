<?php
// affichage de la page d'accueil
// ce fichier est le seul que l'on laisse a la racine du site, afin de satisfaire le sujet
// du projet. Tous les autres fichiers de presentation sont dns le repertoire view

session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Camagru</title>
<meta charset="UTF-8">
<meta name="description" content="Projet Camagru Ecole 42">
<meta name="keywords" content="HTML,CSS,PHP,JavaScript,MySql">
<meta name="author" content="Antoine Jouannais / Xavier Milleron">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" href="css/application.css" />
</head>

<?php
require __DIR__ . '/control/app_index.php';
include('view/header.php');
include('view/content_index.php');
include('view/footer.php');
?>
</html>
