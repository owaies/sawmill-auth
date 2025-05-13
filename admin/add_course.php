<?php
session_start();
require '../db.php';

$title = $_POST['title'];
$description = $_POST['description'];
$created_at = new MongoDB\BSON\UTCDateTime();

$courses->insertOne([
  'title' => $title,
  'description' => $description,
  'created_at' => $created_at,
]);

header("Location: dashboard.php");
?>
