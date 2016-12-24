<?php

class Category {
    
    // database connection and table name
    private $conn;
    private $tableName = "t_category";
    
    // object properties
    public $categoryId;
    public $categoryName;
    public $description;
    
    // contructor woth $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
   
    function create(){
        
        // query to insert record
        $query = "INSERT INTO
                    " . $this->tableName . "
                    SET
                        category_name=:category_name, description=:description";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        //bind values
        $stmt->bindParam(":category_name", $this->categoryName);
        $stmt->bindParam(":description", $this->description);
        
        // execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    public function index($position, $offset){
        // select all query
		if($_GET['q'] != NULL){
			$query = "SELECT * FROM " . $this->tableName . "
				  WHERE
				  category_name LIKE CONCAT('%', :category_name, '%')
				  OR
				  description LIKE CONCAT('%', :description, '%')
                  ORDER BY category_id ASC
				  LIMIT $position, $offset";
		} else {
			$query = "SELECT * FROM " . $this->tableName . "
                  ORDER BY category_id ASC
				  LIMIT $position, $offset";
		}
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
		
        $stmt->bindParam(':category_name', $_GET['q']);
        $stmt->bindParam(':description', $_GET['q']);
        // execute query
        $stmt->execute();
        
        return $stmt;
    }
    
    public function indexAll(){
        // select all query
        $query = "SELECT * FROM " . $this->tableName . "
                  ORDER BY category_id ASC";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }
    
    public function showOne(){
        // query
        $query = "SELECT * FROM " . $this->tableName . " 
                    WHERE category_id = ?
                    LIMIT 0,1";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // bind id
        $stmt->bindParam(1, $this->categoryId);
        
        // execute query 
        $stmt->execute();
        
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        
        // set values to object properties
        $this->categoryName = $row->category_name;
        $this->description = $row->description;
    }
    
    public function update(){
        
        // query
        $query = "UPDATE " . $this->tableName . " 
        SET 
        category_name=:category_name, 
        description=:description 
        WHERE 
        category_id =:category_id";
            
        // prepare statement
        $stmt = $this->conn->prepare($query);
        
        // bind values
        $stmt->bindParam(":category_name", $this->categoryName);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category_id", $this->categoryId);
        
        // execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    public function delete(){
        // query
        $query = "DELETE FROM " . $this->tableName . " WHERE category_id = ?";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
         
        // bind id of record to delete
        $stmt->bindParam(1, $this->categoryId);
     
        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}