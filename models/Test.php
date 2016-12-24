<?php

class Test {
	
	private $conn;
	private $tableName = 'test';
	
	public $name;
	public $phone;
	
	public function create(){
		$query = "INSERT INTO " . $this->tableName . "
				  SET
				  name=:name, phone=:phone";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':phone', $this->phone);
		
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
	
	public function index(){
		$query = "SELECT * FROM " . $this->tableName .
			
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		
		return $stmt;
	}
}