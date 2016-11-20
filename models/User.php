<?php

class User {
    
    private $conn;
    private $tableName = 'user';
    
    // class properties
    
	public $userId;
    public $user;
    public $pass;
    public $rememberToken;
    public $level;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    public function create(){
        
        $query = "INSERT INTO " . $this->tableName . 
                 "  SET
                    user=:user,
                    pass=:pass,
                    remember_token=:remember_token,
					level=:level
					";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':user', $this->user);
        $stmt->bindParam(':pass', $this->pass);
        $stmt->bindParam(':remember_token', $this->rememberToken);
		$stmt->bindParam(':level', $this->level);
        
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
	public function index($position, $offset){
		if($_GET['q'] != NULL){
			$query = "SELECT user_id, user, level FROM " . $this->tableName . " 
		          WHERE 
				  user LIKE CONCAT('%', :user, '%')
			      ORDER BY user_id ASC
				  LIMIT $position, $offset";
		} else {
			$query = "SELECT user_id, user, level FROM " . $this->tableName . " ORDER BY user_id ASC LIMIT $position, $offset";
		}
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':user', $_GET['q']);
		
		$stmt->execute();
		
		return $stmt;
	}
	
	public function update(){
		
		$query = "UPDATE " . $this->tableName . " 
			  	  SET
				  user=:user,
				  pass=:pass,
				  remember_token=:remember_token,
				  level=:level
				  WHERE user_id=:user_id";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':user', $this->user);
		$stmt->bindParam(':pass', $this->pass);
		$stmt->bindParam(':remember_token', $this->rememberToken);
		$stmt->bindParam(':level', $this->level);
		$stmt->bindParam(':user_id', $this->userId);
		
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
		
	}
	
    public function showOne(){
        
        $query = "SELECT user, pass, remember_token, level FROM " . $this->tableName .
                  " WHERE user_id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->userId);
        
        $stmt->execute();
        
        return $stmt;
    }
	
	public function Auth(){
        
        $query = "SELECT user, pass, remember_token, level FROM " . $this->tableName .
                  " WHERE user = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->user);
        
        $stmt->execute();
        
        return $stmt;
    }
	
	public function delete(){
		$query = "DELETE FROM " . $this->tableName . " WHERE user_id = ?";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(1, $this->userId);
		
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
}