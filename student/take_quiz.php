<?php
session_start();
require '../db.php';

$userId = $_SESSION['user']['id'];
$quizId = $_POST['quiz_id'];
$answers = $_POST['answers']; // associative array
$score = calculateScore($answers); // custom logic

$quizzes->updateOne(
  ['_id' => new MongoDB\BSON\ObjectId($quizId)],
  ['$push' => ['submissions' => [
    'user_id' => $userId,
    'answers' => $answers,
    'score' => $score,
    'submitted_at' => new MongoDB\BSON\UTCDateTime()
  ]]]
);

echo "Quiz submitted successfully.";
?>
