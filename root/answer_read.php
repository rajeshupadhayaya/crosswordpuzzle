<?php

// $answerfile = "../core/answer.json";
// $data = fread($answerfile,filesize($answerfile));
// fclose($answerfile);
// $data = file_get_contents($grid_id);
include 'db.php';

$grid_id = file_get_contents("php://input");

$query = 'select answer from answer where puzzle_id="'.$grid_id.'"';
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);

echo $row['answer'];

?>
