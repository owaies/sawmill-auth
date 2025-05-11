<?php
require 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Check if user exists
$existing = $collection->findOne(['email' => $email]);

if ($existing) {
  echo "User already exists!";
} else {
  $collection->insertOne([
    'name' => $name,
    'email' => $email,
    'password' => $password
  ]);
  echo "Signup successful! <a href='index.html'>Login</a>";
}
?>
