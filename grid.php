<?php 

include('root/db.php');

if(isset($_GET['id'])) {
	$id = mysql_real_escape_string($_GET['id']);
	
	$query = "select html from puzzle where puzzle_id ='".$id."'";

	$result = mysql_query($query);
		
	$row = mysql_fetch_assoc($result);
	echo '<input type="hidden" id="grid_id" value='.$id.' >';
	echo base64_decode($row['html']);

}else{
	echo 'Page Not found';
}

?>