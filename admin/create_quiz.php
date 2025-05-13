<?php
require '../db.php';
session_start();

// Admin check
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$courses = $courseCollection->find();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $courseId = new MongoDB\BSON\ObjectId($_POST['course_id']);
    $questions = json_decode($_POST['questions'], true); // Expecting an array of {question, options, answer}

    $quiz = [
        'title' => $title,
        'course_id' => $courseId,
        'questions' => $questions,
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ];

    $quizCollection->insertOne($quiz);
    header("Location: quizzes.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Quiz</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h2>Create New Quiz</h2>
<form method="post">
    <label>Quiz Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Course:</label><br>
    <select name="course_id" required>
        <?php foreach ($courses as $course): ?>
            <option value="<?php echo $course['_id']; ?>"><?php echo $course['title']; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Questions (JSON format):</label><br>
    <textarea name="questions" rows="10" cols="80" required>[{"question": "Example?", "options": ["A", "B", "C", "D"], "answer": "A"}]</textarea><br><br>

    <button type="submit">Create Quiz</button>
</form>
</body>
</html>
