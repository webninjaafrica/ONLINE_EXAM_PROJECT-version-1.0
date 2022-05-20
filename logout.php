<?php
session_start();
include_once("includes/autoload.php");
if (isset($_SESSION['username'])) {
	$username=$_SESSION['username'];
	$login=new login($username);

	if ($login->updateLastLogin()) {
		$session=new session($username);
		session_destroy();
		echo "<script>window.location.href='index.php';</script>";
	}
}else{
	echo "error";
}

 ?>