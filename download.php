<?php

$file = 'grid.html';
$data = file_get_contents("php://input");
//print_r($data);

$data_to_write = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Crossword Puzzle</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.4/mootools-yui-compressed.js"></script>
<link rel="stylesheet" type="text/css" href="dist/css/style.css">
<script type="text/javascript" src="dist/js/crossword.js"></script>
<script type="text/javascript" src="dist/js/script.js"></script>
<script type="text/javascript">
var empId = "";
window.onload = function(){
	empId = prompt("Please enter your Emp Id", "123456");
	
	var minutesLabel = document.getElementById("minutes");
	var secondsLabel = document.getElementById("seconds");
	var totalSeconds = 0;
	setInterval(setTime, 1000);

	function setTime()
	{
		++totalSeconds;
		secondsLabel.value = pad(totalSeconds%60);
		minutesLabel.value = pad(parseInt(totalSeconds/60));
	}

	function pad(val)
	{
		var valString = val + "";
		if(valString.length < 2)
		{
			return "0" + valString;
		}
		else
		{
			return valString;
		}
	}
}
</script>
</head>
<body>
' . $data.'</body>
</html>';

$fw = fopen($file, 'w');
fwrite($fw, $data_to_write);
fclose($fw);
$server  = $_SERVER['SERVER_NAME'];
echo 'Your Link is: <a href="grid.html" target="_blank">'.$server.'/grid.html</a>';



?>