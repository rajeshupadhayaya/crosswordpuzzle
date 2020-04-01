<?php 

include('root/db.php');

if(isset($_GET['id'])) {
	$id = mysql_real_escape_string($_GET['id']);
	
	$query = "select html from puzzle where puzzle_id ='".$id."'";

	$result = mysqli_query($conn, $query);
		
	$row = mysqli_fetch_assoc($result);
	echo '<input type="hidden" id="grid_id" value='.$id.' >';
	echo base64_decode($row['html']);

}else{
	echo 'Page Not found';
}

?>