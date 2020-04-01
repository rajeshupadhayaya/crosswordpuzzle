<?php

$ON_HEROKU = getenv('ON_HEROKU');

if($ON_HEROKU) {
	$conn = mysql_connect(getenv('HOST'), getenv('USERNAME'), getenv('PASSWORD')) or die(mysql_error());
	mysql_set_charset('utf8mb4',$conn);
	mysql_select_db("crossword") or die(mysql_error());	
}else{
	$conn = mysql_connect('localhost', 'root', '') or die(mysql_error());
	mysql_set_charset('utf8mb4',$conn);
	mysql_select_db("crossword") or die(mysql_error());	

}
?>