<?php
// $file = 'result.txt';
// $data = file_get_contents("php://input");
// file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
include 'db.php';

$json = file_get_contents("php://input");

$data = json_decode($json);

echo $data->data;

$query = "INSERT INTO result (puzzle_id, result) value('".$data->grid_id."', '".htmlentities($data->data)."')";

$result = mysql_query($query);

if(!$result){
	$message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}

?>