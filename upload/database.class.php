<?php

class Database {
	
	private $host = 'localhost';
	private $user = 'root';
	private $pass = '';
	private $db = 'nsproject';
	
	public function connect() {
		return $dbh = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
	}
}

$db = new Database();

?>