<?php
include_once("autoload.php");

class filemanager extends connection
{
	var $fileid,$file_exist,$details,$username,$folder,$folderdetails;
	function __construct($username,$folder="NEW FOLDER")
	{	$this->username=$username;
		if ($folder=="NEW FOLDER") {
			$folder=$username;
		}
		$this->folder=$folder;
		parent::__construct();
		$q="select *from filemanager where owner=:username and folder=:folder";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":username",$username);
		$stmt->bindParam(":folder",$folder);
		$stmt->execute();

		$qr="select *from folders where owner=:username and folder_id=:folder";
		$stmtr=$this->con->prepare($qr);
		$stmtr->bindParam(":username",$username);
		$stmtr->bindParam(":folder",$folder);
		$stmtr->execute();
		$this->folderdetails=$stmtr->fetch(PDO::FETCH_ASSOC);

		$this->file_exist=$stmt->rowCount();
		$this->details=array();
		while($s=$stmt->fetch(PDO::FETCH_ASSOC)){
			$file=$s['pathx'];
			$type=$s['extensionx'];
			$filename=$s['filename'];
			$comment=$s['comment'];
			$f=array();
			$f['path']=$file;
			$f['extension']=$type;
			$f['filename']=$filename;
			$f['comment']=$comment;
			array_push($this->details, $f);
		}
		#$this->details=json_encode($this->details);

	}

	public function listFolders($username){
		$q="select * from folders where owner=:username";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":username",$username);
		$stmt->execute();
		$this->file_exist=$stmt->rowCount();
		$data=array();
		while($s=$stmt->fetch(PDO::FETCH_ASSOC)){
			$z=array();
			$z['folder_name']=$s['folder_name'];
			$z['folder_id']=$s['folder_id'];
			$z['created_date']=$s['created_date'];
			array_push($data, $z);
		}

		return $data;
	}

	public function deleteFile($path){
		$error="";
		$q="delete from filemanager where owner=:username and path=:path";
		if (file_exists($path)) {
		unlink($path);
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":owner",$this->username);
		$stmt->bindParam(":path",$path);
		$stmt->execute();
		$error= "deleted successifully";
	  }else{
	  	$error="file does not exist";
	  }
		
	  return $error;
	}

	public function addFolder($folder_name,$owner,$has_passord="FALSE",$password=""){
		$q="insert into folders(folder_name,owner) values(:folder_name,:owner)";
		if ($has_passord!=="FALSE") {
			$q="insert into folders(folder_name,owner,password) values(:folder_name,:owner,:password)";
		}
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":owner",$this->username);
		if ($has_passord!=="FALSE") {
		$stmt->bindParam(":password",$password); }
		$stmt->bindParam(":folder_name",$folder_name);
		
		$stmt->execute();
		$notification=new notification();
		$message="You created a new folder: ".$folder_name;
		$title="New folder created";
		$receiver=$this->username;
		$notification->send($receiver,$title,$message);
		return "folder created successifully";
	}

	public function addFile($path,$filename,$comment){
		$pathinfo=pathinfo($path,PATHINFO_EXTENSION);
		$q="insert into filemanager(pathx,owner,extensionx,filename,comment,folder) values(:pathx,:owner,:extensionx,:filename,:comment,:folder)";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":owner",$this->username);
		$stmt->bindParam(":pathx",$path);
		$stmt->bindParam(":extensionx",$pathinfo);
		$stmt->bindParam(":filename",$filename);
		$stmt->bindParam(":comment",$comment);
		$stmt->bindParam(":folder",$this->folder);
		$stmt->execute();
		$notification=new notification();
		$message="You have received one file: <a href='".$path." class='fa fa-link'>  VIEW</a>";
		$title="New file received";
		$receiver=$this->username;
		$notification->send($receiver,$title,$message);
	}

	public function upload($htmlfile,$folder,$title,$comment){
		$error=array();
		$error['status']="upload failed";
		$error['path']="";
		$path="uploads/users/".basename($_FILES[$htmlfile]['name']);
		$pi=pathinfo($path,PATHINFO_EXTENSION);
		$path="uploads/users/".md5(mt_rand(0,999)."-km-p-".mt_rand(0,23).sha1(mt_rand(0,999)."-km-magochi-p-".mt_rand(0,23))).".".$pi;
		if (move_uploaded_file($_FILES[$htmlfile]['tmp_name'], $path)) {
			$f=new filemanager($this->username,$this->folder);
			$f->addFile($path,$title,$comment);
			
			$error['status']="uploaded successifully.";
			$error['path']=$path;
		}
		return $error;
	}

}
?>