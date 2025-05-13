<?php
require '../db.php';
session_start();

// Admin auth check
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $quizId = new MongoDB\BSON\ObjectId($_GET['id']);
    $quizCollection->deleteOne(['_id' => $quizId]);

    // Optional: remove associated student results
    $userCollection->updateMany(
        [],
        ['$pull' => ['quiz_results' => ['quiz_id' => $quizId]]]
    );
}
header("Location: quizzes.php");
exit();
