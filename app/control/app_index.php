<?php
require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../model/User.class.php';
require __DIR__ . '/../model/DBAccess.class.php';


$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);
