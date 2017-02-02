<?php
	session_start();
	require __DIR__ . '/../control/app_create_account.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Camagru - creation de compte</title>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" href="../css/application.css" />
</head>
<div class="container">
<?php
    include('../view/header.php');
    include('../view/content_create_account.php');
    include('../view/footer.php');
?>
</div>
</html>
