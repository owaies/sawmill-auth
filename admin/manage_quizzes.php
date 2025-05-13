<?php
require '../db.php';
session_start();

// Fetch all quizzes
$quizzes = $quizCollection->find();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Quizzes</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="dashboard">
    <h1>Manage Quizzes</h1>
    <a href="dashboard.php">← Back to Dashboard</a>
    <table border="1" cellpadding="10">
      <tr>
        <th>Quiz Title</th>
        <th>Questions Count</th>
        <th>Actions</th>
      </tr>
      <?php foreach ($quizzes as $quiz): ?>
        <tr>
          <td><?php echo htmlspecialchars($quiz['title']); ?></td>
          <td><?php echo count($quiz['questions']); ?></td>
          <td>
            <a href="edit_quiz.php?id=<?php echo $quiz['_id']; ?>">Edit</a> |
            <a href="delete_quiz.php?id=<?php echo $quiz['_id']; ?>" onclick="return confirm('Delete this quiz?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <br>
    <a href="
