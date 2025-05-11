<?php
require 'vendor/autoload.php'; // Composer MongoDB driver

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->sawmill->users;
?>
