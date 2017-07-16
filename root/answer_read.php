<?php

$answerfile = "../core/answer.json";
/*$data = fread($answerfile,filesize($answerfile));
fclose($answerfile);*/
$data = file_get_contents($answerfile);
echo $data;

?>
