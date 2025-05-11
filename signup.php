<?php
require 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password']; // plain text password

// Check if user exists
$existing = $collection->findOne(['email' => $email]);

if ($existing) {
  echo "User already exists!";
} else {
  $collection->insertOne([
    'name' => $name,
    'email' => $email,
    'password' => $password // saved directly
  ]);
  echo "Signup successful! <a href='index.html'>Login</a>";
}
?>
