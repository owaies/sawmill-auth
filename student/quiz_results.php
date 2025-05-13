<?php
require '../db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

$email = $_SESSION['user']['email'];

// Fetch the student's quiz history
$user = $userCollection->findOne(['email' => $email]);
$quizHistory = $user['quiz_results'] ?? [];

// Prepare quiz titles
$quizIds = array_column($quizHistory, 'quiz_id');
$quizzes = iterator_to_array($quizCollection->find(['_id' => ['$in' => $quizIds]]));
$quizTitles = [];
foreach ($quizzes as $quiz) {
    $quizTitles[(string)$quiz['_id']] = $quiz['title'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Quiz Results</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="dashboard">
    <h1>My Quiz Results</h1>
    <a href="dashboard.php">← Back to Dashboard</a>
    <table border="1" cellpadding="10">
      <tr>
        <th>Quiz Title</th>
        <th>Score</th>
        <th>Date</th>
      </tr>
      <?php foreach ($quizHistory as $result): ?>
        <tr>
          <td><?php echo htmlspecialchars($quizTitles[(string)$result['quiz_id']] ?? 'Unknown'); ?></td>
          <td><?php echo $result['score']; ?>%</td>
          <td><?php echo date('Y-m-d H:i', strtotime($result['date'])); ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
