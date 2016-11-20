<?php

class Unit {
    
    private $conn;
    private $tableName = 't_unit';
    
    public $unitId;
    public $unitCode;
    public $unitName;
    public $description;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    public function create(){
        
        // query insert new record
        $query = "INSERT INTO " . $this->tableName . 
            " SET 
            unit_name=:unit_name, description=:description";
        
        // prepare statement
        $stmt = $this->conn->prepare($query);
        
        // bind Values
        $stmt->bindParam(':unit_name', $this->unitName);
        $stmt->bindParam(':description', $this->description);
        
        // execute 
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    public function index($position, $offset){
        
        // query for show record
        if($_GET['q'] != NULL){
			$query = "SELECT * FROM " . $this->tableName . " WHERE unit_name LIKE CONCAT('%', :unit_name, '%')
					  ORDER BY unit_id ASC LIMIT $position, $offset";
		} else {
			$query = "SELECT * FROM " . $this->tableName . " ORDER BY unit_id ASC LIMIT $position, $offset";
		}
        
        // prepare statement
        $stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':unit_name', $_GET['q']);
        
        // execute statement
        $stmt->execute();
        
        return $stmt;
    }
    
    public function indexAll(){
        
        // query for show record
        $query = "SELECT * FROM " . $this->tableName . " ORDER BY unit_id ASC";
        
        // prepare statement
        $stmt = $this->conn->prepare($query);
        
        // execute statement
        $stmt->execute();
        
        return $stmt;
    }
    
    public function showOne(){
        // query
        $query = "SELECT * FROM " . $this->tableName . " 
                    WHERE unit_id = ?
                    LIMIT 0,1";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // bind id
        $stmt->bindParam(1, $this->unitId);
        
        // execute query 
        $stmt->execute();
        
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        
        // set values to object properties
        $this->unitName = $row->unit_name;
        $this->description = $row->description;
    }
    
    public function readOne(){
        $query = "SELECT * FROM " . $this->tableName . " 
                  WHERE unit_id = ?
                  LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->unitId);
        
        $stmt->execute();
        
        return $stmt;
    }
    
    public function update(){
        
        // query
        $query = "UPDATE " . $this->tableName . " 
        SET 
        unit_name=:unit_name, 
        description=:description 
        WHERE 
        unit_id =:unit_id";
            
        // prepare statement
        $stmt = $this->conn->prepare($query);
        
        // bind values
        $stmt->bindParam(":unit_name", $this->unitName);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":unit_id", $this->unitId);
        
        // execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    public function delete(){
        // query
        $query = "DELETE FROM " . $this->tableName . " WHERE unit_id = ?";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
         
        // bind id of record to delete
        $stmt->bindParam(1, $this->unitId);
     
        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}