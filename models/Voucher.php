<?php

class Voucher {
	
	private $conn;
	private $tableName = 'voucher';

	public $voucherId;
	public $customerId;
	public $voucherValue;
	public $status;
	public $invoiceId;

	public function __construct($db){
		$this->conn = $db;
	}

	public function create(){
		$query = "INSERT INTO " .$this->tableName . " SET customer_id=:customerId, voucher_value=:voucherValue, status=:status";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':customerId', $this->customerId);
		$stmt->bindParam(':voucherValue', $this->voucherValue);
		$stmt->bindParam(':status', $this->status);
		// execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
	}

	public function update(){
		$query = "UPDATE " . $this->tableName . " SET voucher_value=:voucherValue WHERE voucher_id=:voucherId";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':voucherValue', $this->voucherValue);
		$stmt->bindParam(':voucherId', $this->voucherId);
		// execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
	}

	public function destroy(){
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

	public function delete(){
		$query = "DELETE FROM " . $this->tableName . " WHERE voucher_id = ?";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $this->voucherId);
    	// execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
	}

	public function showOne(){
		$query = "SELECT * FROM " . $this->tableName . " WHERE voucher_id=:voucher_id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':voucher_id', $this->voucherId);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_OBJ);

		$this->customerId = $row->customerId;
		$this->status = $row->status;
		$this->voucherValue = $row->voucher_value;
	}

	public function index(){
		$query = "SELECT * FROM " . $this->tableName ." WHERE customer_id=:customer_id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':customer_id', $this->customerId);
		$stmt->execute();
		return $stmt;
	}

}

?>