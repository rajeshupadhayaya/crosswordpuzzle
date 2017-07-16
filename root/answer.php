<?php

$file = '../core/answer.json';
$data = json_encode($_POST);
$fw = fopen($file, 'w');
fwrite($fw, $data);
fclose($fw);
echo 'success';


?>