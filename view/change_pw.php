<?php
	session_start();
	require __DIR__ . '/../control/app_change_pw.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Camagru - changement de mot de passe</title>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" href="../css/application.css" />
</head>
<div class="container">
<?php
    include('../view/header_change_pw.php');
    include('../view/content_change_pw.php');
    include('../view/footer.php');
?>
</div>
<?php
footer();
?>
</html>
