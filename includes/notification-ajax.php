<?php session_start();
if(isset($_SESSION['username'])) {
 include_once("autoload.php");
 $en=new encrypt();
 $uid=$_SESSION['username'];
 if (isset($_GET['uid'])) {
 	$uid=$_GET['uid'];
 	$uid=$en->show($uid);
 }
 $n=new notification("NO");
 echo "(".$n->getCount($uid).")";
 }else{
 	echo "error";
 } ?>