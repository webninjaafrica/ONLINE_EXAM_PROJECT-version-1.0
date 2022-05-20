<?php include_once("autoload.php");
if (isset($_GET['nm'])) {
 	$c=new country($_GET['nm']);
 	$de=$c->details;
 	echo $de['phonecode'];
 } ?>