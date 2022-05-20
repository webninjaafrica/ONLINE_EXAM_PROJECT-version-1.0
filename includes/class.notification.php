<?php
include_once("autoload.php");

/**
 * 
 */
class notification extends connection
{
	var $id,$details,$rows;
	function __construct($id=""){

		parent::__construct();
		$this->id=$id;
		$q="select *from messages where id=:process_id";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":process_id",$id);
		$stmt->execute();
		$this->rows=$stmt->rowCount();
		$this->details=$stmt->fetch(PDO::FETCH_ASSOC);
		
	}

	public function getCount($receiver,$archive="NO"){
		$q="select *from messages where readr=:read and archived=:archived and receiver=:receiver";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":read",$this->id);
		$stmt->bindParam(":receiver",$receiver);
		$stmt->bindParam(":archived",$archive);
		$stmt->execute();
		return $stmt->rowCount();

	}



	public function getCountAll($receiver,$archive="NO"){
		$q="select *from messages where archived=:archived and receiver=:receiver";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":receiver",$receiver);
		$stmt->bindParam(":archived",$archive);
		$stmt->execute();
		return $stmt->rowCount();

	}

	public function send($receiver,$title,$message,$sender="SYSTEM",$type="system"){
		$q="insert into messages(receiver,title,message,typem,sender) values(:receiver,:title,:message,:typem,:sender)";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":receiver",$receiver);
		$stmt->bindParam(":title",$title);
		$stmt->bindParam(":message",$message);
		$stmt->bindParam(":typem",$type);
		$stmt->bindParam(":sender",$sender);
		$stmt->execute();
		return "<div class='alert alert-success'>sent..</div>";
	}


	public function read(){
		$q="update messages set readr=:read where id=:id";
		$read="YES";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":read",$read);
		$stmt->bindParam(":id",$this->id);
		$stmt->execute();

	}

	public function archive($read="YES"){
		$q="update messages set archived=:read where id=:id";
		
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":read",$read);
		$stmt->bindParam(":id",$this->id);
		$stmt->execute();

	}

	public function listThem($receiver,$archived="NO"){

		$q="select *from messages where receiver=:receiver and archived=:archived order by id asc limit 0, 20000";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":receiver",$receiver);
		$stmt->bindParam(":archived",$archived);
		$stmt->execute();
		$data="<div class='table-responsive'><table class='table table-hover table-bordered' id='sampleTable'><thead>
		<tr class='bg-info'><th>#Ref.No</th><th>From</th> <th> Received</th> 
		 <th>Title</th>  <th>Info</th>  <th>View</th> <th>ACTION</th> </tr> <thead><tbody>";
		 while ($d=$stmt->fetch(PDO::FETCH_ASSOC)) {
		 	$hi="class='' style='color:#323232;background:#e3e3e3;'";
		 	if ($d['readr']=="YES") {
		 		$hi="style='background:white;'";
		 	}
		 	$m=substr($d['message'], 0,100)."...";
		 	$data.="<tr ".$hi."> <td>".$d['id']."</td>
		 	<td>".$d['sender']."</td> 
		 	 <td>".$d['date']."</td>   <td>".$d['title']."</td> 
		 	  <td>".$m."</td> 
		 	   <td><a href='view-message.php?id=".$d['id']."'class='btn btn-primary btn-sm'>View</a></td>
		 	   <td><a href='?arc=".$d['id']."' class='btn btn-danger btn-sm'> <i class='fa fa-trash'></i> arc.</a></td> </tr>";
		 }

		$data.="</tbody></table></div>";
		return $data;


	}
}



 ?>