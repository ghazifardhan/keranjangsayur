<?php

class Payment {
    
    private $conn;
    private $tableName = 'payment_method';
    
    public $paymentMethodName;
    public $paymentDescription;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    public function create(){
        $query = "INSERT INTO " . $this->tableName . "
                  SET
                  payment_method_name=:payment_method_name,
                  description=:description
                  ";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':payment_method_name', $this->paymentMethodName);
        $stmt->bindParam(':description', $this->description);
    }
    
    public function index(){
        
        $query = "SELECT * FROM " . $this->tableName . " ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        
        return $stmt;
    }
}