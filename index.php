<?php
  require __DIR__ . '/app/control/app.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Camagru</title>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" href="css/application.css" />
</head>
<div class="container">
<?php
    include('app/view/header.php');
    include('app/view/content.php');
    include('app/view/footer.php');
?>
</div>
</html>
