<?php

class SetInvoice {
	
	private $conn;
	private $tableName = 'invoice_code';
	
	public $sku;
	public $invoiceCodeOne;
	public $invoiceCodeTwo;
	public $date;
	public $createdAt;
	public $updatedAt;
	
	public function __construct($db){
		
		$this->conn = $db;
		
	}
	
	public function getInvoiceCode(){
		
		$query = "SELECT sku, invoice_code_1, invoice_code_2, date FROM " . $this->tableName;
			
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		
		return $stmt;
	}
	
	public function updateInvoiceCode(){
		
		$query = "UPDATE invoice_code 
					SET 
				  invoice_code_1=:invoice_code_1,
				  invoice_code_2=:invoice_code_2,
				  date=:date
				  ";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':invoice_code_1', $this->invoiceCodeOne);
		$stmt->bindParam(':invoice_code_2', $this->invoiceCodeTwo);
		$stmt->bindParam(':date', $this->date);
		
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}	
}