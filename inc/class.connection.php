<?php
class connection
{
	var $con;
	function __construct(){

		try{

			$dsn="mysql:host=localhost;dbname=exams";
			$user="root";
			$pass="";
			$this->con=new PDO($dsn,$user,$pass);
		}catch(PDOException $e){
			die("Error 21101: ".$e->getMessage());
		}
		
	}
}



$r=new connection();

 ?>