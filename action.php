<?php 

include "database.php";
/**
* 
*/
class DataOparation extends database
{
	
	public function insert_record($table,$fields)
	{
		$sql = "";
		$sql .= "INSERT INTO ".$table;
		$sql .= " (".implode(",", array_keys($fields)).")values ";
		$sql .= "('".implode("','", array_values($fields))."')";
		$query = mysqli_query($this->con,$sql);
		if($query){
			return true;
		}
	}
	 public function fetch_record($table)
	{
		$sql = "select * from ".$table;
		$array =  array();
		$query = mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)){
			$array[] = $row;
		}
		return $array;
	}
	public function select_record($table,$where){
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='". $value . "' AND ";
		}
		 $condition = substr($condition, 0, -5);
		 $sql .= "SELECT * FROM ".$table." WHERE ".$condition;
		 $query = mysqli_query($this->con, $sql);
		 $row = mysqli_fetch_array($query);
		 return $row;
	}
	public function update_record($table,$where,$fields){
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='". $value . "' AND ";
		}
		 $condition = substr($condition, 0, -5);
		 foreach ($fields as $key => $value) {
			$sql .= $key . "='". $value . "', ";
		}
		$sql = substr($sql, 0,-2);
		$sql = "update ".$table." set ".$sql." where ".$condition;
		if(mysqli_query($this->con, $sql)){
			return true;
		}
	}
	public function delete_record($table,$where){
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value . "' AND ";
		}
		 $condition = substr($condition, 0, -5);
		 $sql = "DELETE FROM ".$table." WHERE ".$condition;
		 if(mysqli_query($this->con, $sql)){
			return true;
		}
	}	
}
	$obj = new DataOparation;

	if(isset($_POST["submit"])){
		$myArray = array(
			"UserName" => $_POST["UserName"],
			"email" => $_POST["email"]
			);
		if($obj->insert_record("students",$myArray)){
			header("location:index.php?msg=Record Inserted Successfully");
	}
}

if(isset($_POST["Edit"])){
		$id = $_POST["id"];
		$where = array("id"=>$id);
		$myArray = array(
			"UserName" => $_POST["UserName"],
			"email" => $_POST["email"]
			);
		if($obj->update_record("students",$where,$myArray)){
			header("location:index.php?msg=Record Updated Successfully");
	}
}
	if(isset($_GET["delete"])){
		$id = $_GET["id"] ?? null;
		$where = array("id"=>$id);

			if($obj->delete_record("students",$where)){
			header("location:index.php?msg=Record Deleted Successfully");
		}
	}
?>