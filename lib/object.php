<?php

include_once "mysqldb.php";

class aObject{
	private $table;
	private $id;
	private $isDeleted;

	
	public function __construct($table){
		$this->table = $table;
	}
	
	public function get( 
						array $fields, 
						array $conditions, 
						$limit
						){
		$selectQuery = "";
		
		if(!empty($this->table) && !empty($fields))
		{
			foreach($fields as $field){
				if($selectQuery==null){
					$selectQuery = "SELECT " .  $field;
				} else {
					$selectQuery = $selectQuery . " ," . $field;	
				}
			}
			$selectQuery = $selectQuery . " FROM $this->table";
		}
		
		if($selectQuery!=null && !empty($conditions)){
			
			$selectQuery = $selectQuery . " WHERE ";
			//add where clause
			foreach($conditions as $key => $value){
				//TO DO : What if numberic value passed need to change the logic here
				$selectQuery = $selectQuery . "$key = '$value' AND ";
			}
			$selectQuery = rtrim($selectQuery, 'AND ');
		}
		// TO DO : What if value comes as non numeric, should we return all or null??
		$limit = (is_integer($limit)) ? $limit : 0;
		if($limit !== 0){
			$selectQuery = $selectQuery . " LIMIT $limit";
		}
		$rows = array();
		//echo "Select Query: <br> $selectQuery <br><br>";
		$db = new database();
		$connection = $db->getConnection();
		$result = $connection -> query ($selectQuery);
		while($row = $result -> fetch_assoc()){
			$rows[]=$row;
		}
		return ($rows);
	}
	
	public function insert(array $fieldValues){
		// FieldValues can be multidimentional array
		/*
		Fields values should be in below format
		array(
			array(key1 => a1, key2=>b1),
			array(key1 => a2, key2=>b2),
			array(key1 => a3, key2=>b3)
		)	
		
		*/
		
		//$fields = implode(', ', array_shift($fieldValues));
		print_r($fieldValues );
		
		$insertQuery ="INSERT INTO $this->table (";
		$columns="";
		if(!empty($this->table) && !empty($fieldValues)){
		// Define columns 		
			foreach($fieldValues[0] as $key=>$value){
				$insertQuery = $insertQuery . "$key ,";
				//echo $fieldValues[0][$key];
			}
			$insertQuery = rtrim($insertQuery,',');
		}
		$insertQuery =$insertQuery . ") VALUES ";
		
		// Insert values
		$values = array();
		foreach ($fieldValues as $row) {
			foreach($row as $key=>$value){
				//clean the value
				//Add logic to identify type of field
				$row[$key] = "'".$row[$key]."'";
			}
			$values[] = "(" . implode(', ', $row) . ")";
		}

		$insertQuery =$insertQuery .implode (', ', $values);
		echo $insertQuery . "<BR>";
		
		/*
		$db = new database();
		$connection = $db->getConnection();
		
		$result = $connection -> query ($insertQuery);
		if(!$result){ 
			echo "Error" . $connection->error;
		}else{
			echo "Records inserted";
		}
		*/
		$this->dbOperation($insertQuery);
	}
	
	public function delete(array $ids){
		
		$deleteQuery = "DELETE FROM $this->table WHERE ID in ";
		if(!empty($this->table) && !empty($ids)){
			
			$deleteQuery = $deleteQuery . "(" . implode(', ', $ids) . ")";
		}	
		
		echo $deleteQuery;
		$this->dbOperation($deleteQuery);
		
	}
	
	public function dbOperation($query){
		$db = new database();
		$connection = $db->getConnection();
		
		$result = $connection -> query ($query);
		if(!$result){ 
			echo "Error" . $connection->error;
		}else{
			echo "Records inserted";
		}
		$connection->close();
	}
	
	public function update($ids, array $fieldValues){
		
		$updateQuery = "";
		
		if(!empty($this->table) && !empty($ids) && !empty($fieldValues) ){
			
			$updateQuery = "UPDATE $this->table SET ";
			
			foreach($fieldValues as $key=>$value){
				$updateQuery = $updateQuery . "$key = '". "$value' WHERE ID IN ";
			}

			$updateQuery = $updateQuery .  "(" . implode(', ', $ids) . ")";
			
			echo $updateQuery;
			/*
			$db = new database();
			$connection = $db->getConnection();			
			$result = $connection -> query ($updateQuery);
			if(!$result){ 
				echo "Error" . $connection->error;
			}else{
				echo "Records inserted";
			}
			*/
			$this->dbOperation($updateQuery);
		}
		
		
	}
}

$user = new aObject("USERS");

$fieldValues =
		array(
			// row 1 in table
			array("Id" => "1", "firstName" => "a1", "LastName"=>"b1", "username" =>"abc1"),
			// row 2 in table
			array("Id" => "2", "firstName" => "a2", "LastName"=>"b2", "username" =>"cde1"),

		);
$ids = array ("1","2","3");
$fields = array("firstName","lastName");
$conditions = array();//array("firstName" => "Poonam");
$limit = 2;
$updatefieldValues = array("firstName" => "xyz");

$result = $user->get($fields,$conditions,$limit);
//$user->delete($ids);
$user->insert($fieldValues);
//$user->update($ids,$updatefieldValues);
$resultJsonEncoded = json_encode($result);
$jsonDecodedResult = json_decode($resultJsonEncoded, true);
print_r($resultJsonEncoded);
print_r( $jsonDecodedResult);
print_r(json_encode($jsonDecodedResult));


?>