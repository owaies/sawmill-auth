<?php
require 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$user = $collection->findOne(['email' => $email]);

if ($user && $password === $user['password']) {
  // Successful login
} else {
  echo "Invalid email or password.";
  exit; // Stop further execution if login fails
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome Page</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(-90deg, #f02e14, #2575fc, #2575fc, #e60808);
      animation: gradientBG 10s ease infinite;
      background-size: 400% 400%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
    }
    @keyframes gradientBG {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

    .welcome-box {
      background: rgba(0, 0, 0, 0.3);
      padding: 40px 60px;
      border-radius: 12px;
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
      text-align: center;
      animation: fadeIn 1s ease-in-out;
    }

    .welcome-box h1 {
      font-size: 32px;
      margin-bottom: 10px;
      color: #fff;
    }

    .welcome-box p {
      font-size: 18px;
      margin-top: 10px;
      color: #eee;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
  <div class="welcome-box">
    <h1>
      <?php echo "Welcome, " . htmlspecialchars($user['name']); ?>
    </h1>
    <p>You have successfully logged in!</p>
  </div>
</body>
</html>
