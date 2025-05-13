<?php
require 'vendor/autoload.php'; // Composer MongoDB driver


$client = new MongoDB\Client("mongodb://localhost:27017");
$database = $client->quiz_platform;
$users = $database->users;
$courses = $database->courses;
$quizzes = $database->quizzes;
?>
