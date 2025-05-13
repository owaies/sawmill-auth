<?php
require '../db.php';

$search = $_GET['search'] ?? '';
$cursor = $courses->find([
  '$text' => ['$search' => $search],
  'created_at' => ['$gte' => new MongoDB\BSON\UTCDateTime(strtotime('-1 year') * 1000)]
]);

foreach ($cursor as $course) {
  echo "<h3>{$course['title']}</h3><p>{$course['description']}</p>";
}
?>
