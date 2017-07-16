<?php
$file = 'result.txt';
$data = file_get_contents("php://input");
file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

?>