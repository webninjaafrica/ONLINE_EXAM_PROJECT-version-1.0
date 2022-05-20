<?php
header("Content-Type: application/json");
$data=array();
$data['id']=$data['names']=$data['api-key']="";
if (isset($_GET['id'])) {
	$data['id']=$_GET['id'];
}
echo json_encode($data);
 ?>