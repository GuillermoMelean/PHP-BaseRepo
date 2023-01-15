<?php
/*
* Mysql database class - only one connection alowed
*/
class Database {
	private $_connection;
	private static $_instance; //The single instance
 
	private $_host = "94.126.169.163";
	private $_username = "anibalte_admin";
	private $_password = "?7Mzk?oTfUjx";
	private $_database = "anibalte_alojamento_local";


	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	private function __construct() {
		$this->_connection = new mysqli($this->_host, $this->_username,$this->_password, $this->_database);
		$this->_connection->set_charset("utf8");
		$this->_connection->autocommit(FALSE);
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}

	public function closeConnection() {
		return $this->_connection->close();
	}

	public function rollbackAndClose() {
		$this->_connection->rollback();
		return $this->closeConnection();
	}

	public function commitAndClose() {
		$this->_connection->commit();
		return $this->closeConnection();
	}

}
