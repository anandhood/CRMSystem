<?php

class login
{
	private $_id;
	private $_username;
	private $_password;
	private $_password5;
	private $_errors;
	private $_access;
	private $_login;
	private $_token;
	
	public function _construct(){
		$this->_errors = array();
		$this->_login = isset($_POST('login')) ? 1 : 0;
		$this->_token = $_POST('token');
		
		$this->_id	=0;
		$this->_username = 
	}
	
}


?>