<?php

$ON_HEROKU = getenv('ON_HEROKU');

if($ON_HEROKU) {
	$conn = mysqli_connect(getenv('HOST'), getenv('USERNAME'), getenv('PASSWORD')) or die(mysql_error());
	
}else{
	$conn = mysqli_connect('localhost', 'root', '') or die(mysql_error());
	
}

mysqli_set_charset($conn, 'utf8mb4');
mysqli_select_db($conn, "crossword") or die(mysql_error());	
?>