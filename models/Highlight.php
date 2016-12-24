<?php

class Highlight {
	
	private $conn;
	private $tableName = 't_highlight';
	
	public $highlightId;
	public $highlightName;
	public $highlightColor;
	public $description;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	public function index($position, $offset){
		if($_GET['q'] != NULL){
		$query = "SELECT * FROM " . $this->tableName . " 
				  WHERE 
				  highlight_name LIKE CONCAT('%', :highlight_name, '%')
				  OR
				  highlight_color LIKE CONCAT('%', :highlight_color, '%')
				  ORDER BY highlight_id ASC
				  LIMIT $position, $offset";
		} else {
			$query = "SELECT * FROM " . $this->tableName . "
                  ORDER BY highlight_id ASC
				  LIMIT $position, $offset";
		}
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':highlight_name', $_GET['q']);
		$stmt->bindParam(':highlight_color', $_GET['q']);
		
		$stmt->execute();
		
		return $stmt;
	}
	
	public function indexAll(){
		$query = "SELECT * FROM " . $this->tableName;
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		
		return $stmt;
	}
	
	public function create() {
		$query = "INSERT INTO " . $this->tableName . " 
			      SET
				  highlight_name=:highlight_name,
				  highlight_color=:highlight_color,
				  description=:description
				  ";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':highlight_name', $this->highlightName);
		$stmt->bindParam(':highlight_color', $this->highlightColor);
		$stmt->bindParam(':description', $this->description);
		
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
	
    public function showOne(){
        
        $query = "SELECT * FROM " . $this->tableName . " WHERE highlight_id = ? LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->highlightId);
        $stmt->execute();
        return $stmt;
        
    }
    
	public function update(){
		$query = "UPDATE " . $this->tableName . " 
		          SET 
				  highlight_name=:highlight_name,
				  highlight_color=:highlight_color,
				  description=:description
				  WHERE
				  highlight_id=:highlight_id
				  ";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':highlight_name', $this->highlightName);
		$stmt->bindParam(':highlight_color', $this->highlightColor);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':highlight_id', $this->highlightId);
		
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
	
	public function delete(){
		$query = "DELETE FROM " . $this->tableName . " 
		          WHERE
				  highlight_id = ?";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(1, $this->highlightId);
		
		// execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
	}
}