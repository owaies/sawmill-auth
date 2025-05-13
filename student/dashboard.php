<?php
require '../db.php';
session_start();

// Check if student is logged in
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

$studentEmail = $_SESSION['user']['email'];

// Fetch enrolled courses (assuming a user has a 'courses' array)
$userData = $userCollection->findOne(['email' => $studentEmail]);
$enrolledCourseIds = $userData['courses'] ?? [];

// Fetch course details
$courses = $courseCollection->find(['_id' => ['$in' => $enrolledCourseIds]]);

// Fetch quizzes available for enrolled courses
$quizzes = $quizCollection->find(['course_id' => ['$in' => $enrolledCourseIds]]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="dashboard">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</h1>
    <h2>Enrolled Courses</h2>
    <ul>
      <?php foreach ($courses as $course): ?>
        <li><?php echo htmlspecialchars($course['title']); ?></li>
      <?php endforeach; ?>
    </ul>

    <h2>Available Quizzes</h2>
    <ul>
      <?php foreach ($quizzes as $quiz): ?>
        <li>
          <?php echo htmlspecialchars($quiz['title']); ?> — 
          <a href="take_quiz.php?id=<?php echo $quiz['_id']; ?>">Take Quiz</a>
        </li>
      <?php endforeach; ?>
    </ul>

    <a href="quiz_results.php">View My Quiz Results</a><br>
    <a href="../logout.php">Logout</a>
  </div>
</body>
</html>
