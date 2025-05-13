<?php
require '../db.php';
session_start();

// Admin auth check
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = new MongoDB\BSON\ObjectId($_GET['id']);
$quiz = $quizCollection->findOne(['_id' => $id]);

// Fetch quiz review breakdown
$reviews = $userCollection->aggregate([
    ['$match' => ['quiz_results.quiz_id' => $id]],
    ['$unwind' => '$quiz_results'],
    ['$match' => ['quiz_results.quiz_id' => $id]],
    [
        '$group' => [
            '_id' => '$quiz_results.quiz_id',
            'average_score' => ['$avg' => '$quiz_results.score'],
            'attempts' => ['$sum' => 1]
        ]
    ]
]);

$reviewData = iterator_to_array($reviews);
$average = $reviewData[0]['average_score'] ?? 0;
$attempts = $reviewData[0]['attempts'] ?? 0;

// Handle edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated = [
        'title' => $_POST['title'],
        'questions' => json_decode($_POST['questions'], true)
    ];
    $quizCollection->updateOne(['_id' => $id], ['$set' => $updated]);
    header("Location: quizzes.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Quiz</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h2>Edit Quiz</h2>
<p><strong>Attempts:</strong> <?= $attempts ?> | <strong>Avg. Score:</strong> <?= round($average, 2) ?>%</p>

<form method="post">
    <label>Quiz Title:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($quiz['title']) ?>" required><br><br>

    <label>Questions (JSON format):</label><br>
    <textarea name="questions" rows="10" cols="80" required><?= json_encode($quiz['questions'], JSON_PRETTY_PRINT) ?></textarea><br><br>

    <button type="submit">Save Changes</button>
</form>
<a href="quizzes.php">← Back to Quiz List</a>
</body>
</html>
