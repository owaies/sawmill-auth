<?php
require 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$user = $collection->findOne(['email' => $email]);

if ($user && password_verify($password, $user['password'])) {
  echo "Welcome, " . $user['name'];
} else {
  echo "Invalid email or password.";
}
?>
