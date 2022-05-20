<?php
class connection
{
	var $con;
	function __construct()
	{
		try{
		$this->con=new PDO("mysql:host=localhost;dbname=exams","root","");
		$this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
}
 ?>