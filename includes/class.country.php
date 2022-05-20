<?php include_once("autoload.php"); 
class country extends connection
{
	var $country,$details,$country_exists;
	function __construct($country_name=""){
		$this->country=$country_name;
		parent::__construct();
		$q="select *from country where nicename=:country";
		$stmt=$this->con->prepare($q);
		$stmt->bindParam(":country",$this->country);
		$stmt->execute();
		$this->country_exists=$stmt->rowCount();
		$this->details=$stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function listCountries(){
		$q="select *from country";
		$stmt=$this->con->prepare($q);
		$stmt->execute();
		$arr=array();
		while ($data=$stmt->fetch(PDO::FETCH_ASSOC)) {
			array_push($arr, $data['nicename']);
		}
		return $arr;
	}

}

?>
