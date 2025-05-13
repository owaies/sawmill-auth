<?php
require '../db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="dashboard">
    <h1>Admin Dashboard</h1>
    <ul>
      <li><a href="manage_quizzes.php">Manage Quizzes</a></li>
      <li><a href="view_reviews.php">View Course Reviews</a></li>
      <li><a href="../logout.php">Logout</a></li>
    </ul>
  </div>
</body>
</html>
