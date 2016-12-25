<?php

class Customer{

	private $conn;
	private $tableName = "customer";

	public $customerId;
	public $customerName;
	public $customerType;
	public $description;

	public function __construct($db){
		$this->conn = $db;
	}

	public function create(){
		$query = "INSERT INTO " . $this->tableName . " SET customer_name=:customerName, customer_type=:customerType, description=:description";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':customerName', $this->customerName);
		$stmt->bindParam(':customerType', $this->customerType);
		$stmt->bindParam(':description', $this->description);

		// execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
	}

	public function update(){
		$query = "UPDATE " . $this->tableName . " SET 
		customer_name=:customerName, 
		customer_type=:customerType, 
		description=:description 
		WHERE customer_id=:customerId";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':customerName', $this->customerName);
		$stmt->bindParam(':customerType', $this->customerType);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':customerId', $this->customerId);

		// execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
	}

	public function showOne(){
		$query = "SELECT * FROM " . $this->tableName;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        
        // set values to object properties
        $this->customerName = $row->customer_name;
        $this->customerId = $row->customer_id;
        $this->customerType = $row->customer_type;
        $this->description = $row->description;
	}

	public function index($position, $offset){
		if($_GET['q'] != NULL){
			$query = "SELECT * FROM " . $this->tableName . "
				  WHERE
				  customer_name LIKE CONCAT('%', :customerName, '%')
				  OR
				  customer_type LIKE CONCAT('%', :customerType, '%')
				  OR
				  description LIKE CONCAT('%', :description, '%')
                  ORDER BY customer_id ASC
				  LIMIT $position, $offset";
		} else {
			$query = "SELECT * FROM " . $this->tableName . " ORDER BY customer_id ASC
				  LIMIT $position, $offset";
		}
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
		
        $stmt->bindParam(':customerName', $_GET['q']);
        $stmt->bindParam(':customerType', $_GET['q']);
        $stmt->bindParam(':description', $_GET['q']);
        // execute query
        $stmt->execute();
        
        return $stmt;
	}

	public function indexAll(){
        // select all query
        $query = "SELECT * FROM " . $this->tableName . "
                  ORDER BY customer_id ASC";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    public function delete(){
    	$query = "DELETE FROM " . $this->tableName . " WHERE customer_id = ?";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $this->customerId);

		// execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
	}

}