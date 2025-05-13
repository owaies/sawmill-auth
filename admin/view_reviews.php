<?php
require '../db.php';
session_start();

$reviews = $reviewCollection->aggregate([
  ['$group' => [
    '_id' => '$course_id',
    'average_rating' => ['$avg' => '$rating'],
    'total_reviews' => ['$sum' => 1]
  ]]
]);

$courses = [];
foreach ($courseCollection->find() as $course) {
  $courses[(string)$course['_id']] = $course['title'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Course Reviews</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="dashboard">
    <h1>Course Reviews</h1>
    <a href="dashboard.php">← Back to Dashboard</a>
    <table border="1" cellpadding="10">
      <tr>
        <th>Course</th>
        <th>Average Rating</th>
        <th>Total Reviews</th>
      </tr>
      <?php foreach ($reviews as $review): ?>
        <tr>
          <td><?php echo htmlspecialchars($courses[(string)$review['_id']] ?? 'Unknown Course'); ?></td>
          <td><?php echo round($review['average_rating'], 2); ?></td>
          <td><?php echo $review['total_reviews']; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</
