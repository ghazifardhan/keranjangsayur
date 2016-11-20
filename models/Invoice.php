<?php

class Invoice {
    
    private $conn;
    private $tableName = 't_invoice';
    
    public $invoiceId;
    public $invoiceCode;
    public $invoiceDate;
    public $customerName;
    public $customerCode;
    public $customerAddress;
    public $customerAddress2;
    public $customerAddress3;
    public $paymentMethod;
    public $shippingDate;
    public $description;
    public $isPaid;
    public $date1;
    public $date2;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    public function create(){
        $query = "INSERT INTO " . $this->tableName . " 
                    SET
                  invoice_code=:invoice_code,
                  invoice_date=:invoice_date,
                  customer_name=:customer_name,
                  customer_phone=:customer_phone,
                  customer_address=:customer_address,
                  customer_address_2=:customer_address_2,
                  customer_address_3=:customer_address_3,
                  payment_method=:payment_method,
                  shipping_date=:shipping_date,
                  description=:description,
                  is_paid=:is_paid
				  ";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':invoice_code', $this->invoiceCode);
        $stmt->bindParam(':invoice_date', $this->invoiceDate);
        $stmt->bindParam(':customer_name', $this->customerName);
        $stmt->bindParam(':customer_phone', $this->customerPhone);
        $stmt->bindParam(':customer_address', $this->customerAddress);
        $stmt->bindParam(':customer_address_2', $this->customerAddress2);
        $stmt->bindParam(':customer_address_3', $this->customerAddress3);
        $stmt->bindParam(':payment_method', $this->paymentMethod);
        $stmt->bindParam(':shipping_date', $this->shippingDate);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':is_paid', $this->isPaid);
        
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    public function readOne(){
        $query = "SELECT 
		          t_invoice.invoice_code,
		          t_invoice.invoice_date,
		          t_invoice.customer_name,
		          t_invoice.customer_phone,
		          t_invoice.customer_address,
		          t_invoice.customer_address_2,
		          t_invoice.customer_address_3,
				  t_invoice.payment_method,
		          payment_method.payment_method_name,
		          t_invoice.shipping_date,
		          t_invoice.description,
		          t_invoice.is_paid
				  FROM " . $this->tableName . " 
				  LEFT JOIN payment_method
				  ON t_invoice.payment_method = payment_method.payment_method_id
                  WHERE invoice_code = ?
                  LIMIT 0,1";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->invoiceCode);
        
        // execute query 
        $stmt->execute();
        
        return $stmt;
    }
    
    public function readTest(){
        $query = "SELECT * FROM " . $this->tableName . " 
                  WHERE invoice_code LIKE %?%
                  LIMIT 0,1";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->invoiceCode);
        
        // execute query 
        $stmt->execute();
        
        return $stmt;
    }
	
	public function index($position, $offset){
		// query
		if($_GET['q'] != NULL){
		$query = "SELECT * FROM " . $this->tableName . "
		          WHERE 
				  invoice_code LIKE CONCAT('%', :invoice_code, '%')
				  OR
				  customer_name LIKE CONCAT('%', :customer_name, '%')
				  OR
				  customer_address LIKE CONCAT('%', :customer_address, '%')
				  OR
				  customer_address_2 LIKE CONCAT('%', :customer_address_2, '%')
				  OR
				  customer_address_3 LIKE CONCAT('%', :customer_address_3, '%')
				  OR
				  customer_phone LIKE CONCAT('%', :customer_phone, '%')
				  OR
				  description LIKE CONCAT('%', :description, '%')
				  ORDER BY invoice_id DESC
		          LIMIT $position,$offset";
		} else {
			$query = "SELECT * FROM " . $this->tableName . "
				  ORDER BY invoice_id DESC
		          LIMIT $position,$offset";
		}
		
		// prepare query
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':invoice_code', $_GET['q']);
		$stmt->bindParam(':customer_name', $_GET['q']);
		$stmt->bindParam(':customer_address', $_GET['q']);
		$stmt->bindParam(':customer_address_2', $_GET['q']);
		$stmt->bindParam(':customer_address_3', $_GET['q']);
		$stmt->bindParam(':customer_phone', $_GET['q']);
		$stmt->bindParam(':description', $_GET['q']);
		// execute
		$stmt->execute();
		
		return $stmt;
	}
    
    public function indexAll(){
		// query
		$query = "SELECT * FROM " . $this->tableName . " ORDER BY invoice_id DESC";
		
		// prepare query
		$stmt = $this->conn->prepare($query);
		
		// execute
		$stmt->execute();
		
		return $stmt;
	}
	
	public function detailPacking(){
		//
		$query = "SELECT 
					t_invoice.invoice_id,
					t_invoice.invoice_code,
					t_invoice.invoice_date,
					t_invoice.customer_name,
					t_invoice.customer_address,
					t_invoice.customer_address_2,
					t_invoice.customer_address_3,
					t_invoice.customer_phone,
					t_invoice.payment_method,
					payment_method.payment_method_name,
					t_invoice.shipping_date,
					t_invoice.total,
					t_invoice.description
					FROM t_invoice
					LEFT JOIN payment_method
					ON t_invoice.payment_method = payment_method.payment_method_id
					WHERE t_invoice.invoice_date = ?
					ORDER BY t_invoice.invoice_code ASC";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(1, $this->invoiceDate);
		
		$stmt->execute();
		
		return $stmt;
	}
	
	public function delete(){
        // query
        $query = "DELETE FROM " . $this->tableName . " WHERE invoice_id = ?";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
         
        // bind id of record to delete
        $stmt->bindParam(1, $this->invoiceId);
     
        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    public function paid(){
        // query
        $query = "UPDATE " . $this->tableName . "
                  SET is_paid = '1'
                  WHERE invoice_code = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->invoiceCode);
        
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
	
	public function unpaid(){
        // query
        $query = "UPDATE " . $this->tableName . "
                  SET is_paid = '0'
                  WHERE invoice_code = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->invoiceCode);
        
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    public function update(){
        
        // query
        $query = "UPDATE " . $this->tableName . " 
        SET 
          invoice_date=:invoice_date,
          customer_name=:customer_name,
          customer_phone=:customer_phone,
          customer_address=:customer_address,
          customer_address_2=:customer_address_2,
          customer_address_3=:customer_address_3,
          payment_method=:payment_method,
          shipping_date=:shipping_date,
          description=:description
        WHERE
        invoice_code =:invoice_code";
            
        // prepare statement
        $stmt = $this->conn->prepare($query);
        
        // bind values
        $stmt->bindParam(':invoice_code', $this->invoiceCode);
        $stmt->bindParam(':invoice_date', $this->invoiceDate);
        $stmt->bindParam(':customer_name', $this->customerName);
        $stmt->bindParam(':customer_phone', $this->customerPhone);
        $stmt->bindParam(':customer_address', $this->customerAddress);
        $stmt->bindParam(':customer_address_2', $this->customerAddress2);
        $stmt->bindParam(':customer_address_3', $this->customerAddress3);
        $stmt->bindParam(':payment_method', $this->paymentMethod);
        $stmt->bindParam(':shipping_date', $this->shippingDate);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':invoice_code', $this->invoiceCode);
        
        // execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
	
	public function setTotal(){
		$query = "UPDATE " . $this->tableName . " 
					SET
					total=:total
					WHERE invoice_code=:invoice_code";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':total', $this->total);
		$stmt->bindParam(':invoice_code', $this->invoiceCode);
		
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
	
	public function getShipping(){
		$query = "SELECT MAX(shipping_date) as shipping FROM " . $this->tableName . " 
					WHERE invoice_date = ?";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(1, $this->invoiceDate);
		
		$stmt->execute();
		
		return $stmt;
	}
	
	public function getTransfer(){
		$query = "SELECT SUM(total) as total FROM " . $this->tableName . " 
		          WHERE payment_method = '1' AND invoice_date = ?";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(1, $this->invoiceDate);
		
		$stmt->execute();
		
		return $stmt;
	}
	
	public function getCash(){
		$query = "SELECT SUM(total) as total FROM " . $this->tableName . " 
		          WHERE payment_method = '2' AND invoice_date = ?";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(1, $this->invoiceDate);
		
		$stmt->execute();
		
		return $stmt;
	}
    
    public function invoiceByDate(){
        $query = "SELECT 
		          t_invoice.invoice_code,
		          t_invoice.invoice_date,
		          t_invoice.customer_name,
		          t_invoice.customer_phone,
		          t_invoice.customer_address,
		          t_invoice.customer_address_2,
		          t_invoice.customer_address_3,
				  t_invoice.payment_method,
		          payment_method.payment_method_name,
		          t_invoice.shipping_date,
		          t_invoice.description,
		          t_invoice.is_paid
				  FROM " . $this->tableName . " 
				  LEFT JOIN payment_method
				  ON t_invoice.payment_method = payment_method.payment_method_id
                  WHERE t_invoice.invoice_date BETWEEN ? AND ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->date1);
        $stmt->bindParam(2, $this->date2);
        
        $stmt->execute();
        
        return $stmt;
    }
}