<?php

class database{
	
	protected static $connection;
	//private $host = "localhost";
	//private $username = "root";
	//private $pwd ="";
	//private $db = "firstcloud";


	public function getConnection(){
		//Check if connection already exists
		if(!isset(self::$connection)){
			//load username/pwd from ini file
			$config = parse_ini_file('./config.ini');
			
			self::$connection = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
		}
		//if conneciton not established throw error
		if(self::$connection === false){
			trigger_error('DB Connection failure<code>' . __CLASS__ . '</code>', E_USER_ERROR);
			return false;
		}
		echo "Connection Good<br>";
		return self::$connection;
	}
	
}

	

/*

$db = new mysqldb();
//$db->insert('users',$fieldValues);
//$result = $db -> get('USERS', $fields, $conditions, $limit);
//$db -> delete("USERS", $ids);
$db -> update("USERS", $ids, $fieldValues);

echo "<br> JSON Representation <br><br>";
print_r(json_encode($result)."<br><br><br>");

//echo "Array Representation <br><br>";
foreach($result as $user){
	print_r ($user);
	echo "<br>";
	print_r ($user['firstName'] . "<br>");
}
*/


?>