<?php

$loginName = 'admin';
$loginPassword = 'password';
if(isset($_POST['loginId']) && isset($_POST['password'])){
	$name = $_POST['loginId'];
	$password = $_POST['password'];
	if(($name == $loginName) && ($password == $loginPassword)){
		echo 'success';
	}
	else {
		echo 'Login Fail, Please provide the input again';
	}
}

?>