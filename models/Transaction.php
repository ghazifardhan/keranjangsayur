<?php

class Transaction {
    
    private $conn;
    private $tableName = 't_transaction';
    
    public $transactionId;
    public $transactionCode;
    public $itemId;
    public $itemQty;
    public $discount;
    public $itemPrice;
    public $description;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    public function create(){
        // query
        $query = "INSERT INTO " . $this->tableName .
                 " SET
                 transaction_code=:transaction_code,
                 item_id=:item_id,
                 item_qty=:item_qty,
                 discount=:discount,
                 item_price=:item_price,
                 description=:description";
        
        // prepare statement
        $stmt = $this->conn->prepare($query);
        
        // bind values
        $stmt->bindParam(':transaction_code', $this->transactionCode);
        $stmt->bindParam(':item_id', $this->itemId);
        $stmt->bindParam(':item_qty', $this->itemQty);
        $stmt->bindParam(':discount', $this->discount);
        $stmt->bindParam(':item_price', $this->itemPrice);
        $stmt->bindParam(':description', $this->description);
        
        //execute
        
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    public function cart(){
        $query = "SELECT * FROM " . $this->tableName . "
                  WHERE transaction_code = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->transactionCode);
        
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        
        $this->transactionId = $row->transaction_id;
        $this->transactionCode = $row->transaction_date;
        $this->customerName = $row->customer_name;
        $this->customerPhone = $row->customer_phone;
        $this->customerAddress = $row->customer_address;
        $this->itemId = $row->item_id;
        $this->itemQty = $row->item_qty;
        $this->itemUnit = $row->item_unit;
        $this->itemPrice = $row->item_price;
        $this->description = $row->description;
    }
	
	public function index(){
		$query = "SELECT
				t_transaction.transaction_id,
				t_transaction.transaction_code,
				t_transaction.item_id,
				t_item.item_name,
				t_transaction.item_qty,
				t_unit.unit_name,
				t_transaction.item_price,
				t_transaction.discount,
				t_item.real_price,
				t_transaction.description,
				t_transaction.created_at,
				t_highlight.highlight_color
				FROM " . $this->tableName . "
				LEFT JOIN t_item
				ON t_transaction.item_id = t_item.item_id
				LEFT JOIN t_unit
				ON t_item.unit_id = t_unit.unit_id
				LEFT JOIN t_highlight
				ON t_item.highlight_id = t_highlight.highlight_id
				WHERE t_transaction.transaction_code =:transaction_code
                ORDER BY t_transaction.created_at ASC
				";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindparam(':transaction_code', $this->transactionCode);
		
		$stmt->execute();
		
		return $stmt;
		
	}
	
	public function update(){
		// query
        $query = "UPDATE " . $this->tableName .
                 " SET
                 item_id=:item_id,
                 item_qty=:item_qty,
                 discount=:discount,
                 item_price=:item_price,
                 description=:description
				 where transaction_id=:transaction_id";
        
        // prepare statement
        $stmt = $this->conn->prepare($query);
        
        // bind values
        $stmt->bindParam(':item_id', $this->itemId);
        $stmt->bindParam(':item_qty', $this->itemQty);
        $stmt->bindParam(':discount', $this->discount);
        $stmt->bindParam(':item_price', $this->itemPrice);
        $stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':transaction_id', $this->transactionId);
        
        //execute
        
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
	}
	
	public function invoice(){
		$query = "SELECT
				t_transaction.transaction_id,
				t_transaction.transaction_code, 
				t_transaction.customer_name, 
				t_transaction.customer_phone, 
				t_transaction.customer_address, 
				t_transaction.item_id, 
				t_item.item_name, 
				t_unit.unit_id, 
				t_unit.unit_name, 
				t_transaction.item_qty,
				t_transaction.discount,
				t_transaction.item_price, 
				t_transaction.description
				FROM " . $this->tableName . "
				LEFT JOIN t_invoice
				ON t_transaction.transaction_code = t_invoice.invoice_code
				LEFT JOIN t_item
				ON t_transaction.item_id = t_item.item_id
				LEFT JOIN t_unit
				ON t_item.unit_id = t_unit.unit_id
				WHERE t_transaction.transaction_code =:transaction_code";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':transaction_code', $this->transactionCode);
		
		// execute query 
        $stmt->execute();
        
		return $stmt;
		
		/*
        // get retrieved row
        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
        {
        // set values to object properties
        $this->transactionId = $row->transaction_id;
        $this->transactionCode = $row->transaction_code;
        $this->customerName = $row->customer_name;
        $this->customerPhone = $row->customer_phone;
        $this->customerAddress = $row->customer_address;
        $this->itemId = $row->item_id;
        $this->itemName = $row->item_name;
        $this->itemQty = $row->item_qty;
        $this->unitId = $row->unitId;
        $this->unitName = $row->unitName;
        $this->itemPrice = $row->item_price;
        $this->description = $row->description;}
		*/
	}
    
    public function delete(){
        // query to delete single transaction
        
        $query = "DELETE FROM " . $this->tableName ." 
                 where transaction_id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->transactionId);
        
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    public function destroy(){
        // query to delete single invoice
        
        $query = "DELETE FROM " . $this->tableName . " 
                  WHERE transaction_code = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->transactionCode);
        
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    public function detailPacking(){
        $query = "SELECT 
        t_invoice.invoice_code, 
        t_invoice.invoice_date, 
        t_invoice.customer_name, 
        t_invoice.customer_phone, 
        t_invoice.customer_address, 
        t_invoice.description, 
        t_invoice.payment_method, 
        t_invoice.shipping_date,
        t_transaction.item_id, 
        t_item.item_name, 
        t_transaction.item_qty, 
        t_transaction.item_price, 
        t_transaction.description
        FROM " . $this->tableName . " 
        LEFT JOIN t_transaction
        ON t_invoice.invoice_code = t_transaction.transaction_code
        LEFT JOIN t_item
        ON t_transaction.item_id = t_item.item_id
        WHERE t_transaction.transaction_code = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->transactionCode);
        
        $stmt->execute();
        
        return $stmt;
    }
	
	public function showOne(){
		
		$query = "SELECT 
                  t_transaction.transaction_id,
                  t_transaction.transaction_code,
                  t_transaction.item_id,
                  t_item.item_name,
                  t_transaction.item_qty,
                  t_transaction.item_price,
                  t_transaction.discount,
                  t_transaction.description,
                  t_unit.unit_name
                  FROM " . $this->tableName . " 
                  LEFT JOIN t_item
                  ON t_transaction.item_id = t_item.item_id
                  LEFT JOIN t_unit
                  ON t_item.unit_id = t_unit.unit_id                  
                  WHERE transaction_id=:transaction_id";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':transaction_id', $this->transactionId);
		
		$stmt->execute();
		
		return $stmt;
		
	}
	
	public function getTotal(){
		$query = "SELECT SUM(item_price) as total FROM " . $this->tableName ." 
		          WHERE transaction_code=:transaction_code";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':transaction_code', $this->transactionCode);
		
		$stmt->execute();
		
		return $stmt;
	}
	
	public function detailPackingSplit(){
		$query = "SELECT
					t_transaction.item_id,
					t_item.item_name,
					t_invoice.invoice_code,
					t_invoice.invoice_date,
					t_invoice.shipping_date,
					t_invoice.customer_name,
					t_transaction.item_qty,
					t_unit.unit_name,
					t_transaction.description,
                    t_highlight.highlight_color
					FROM " . $this->tableName . "
					LEFT JOIN t_invoice
					ON t_transaction.transaction_code = t_invoice.invoice_code
					LEFT JOIN t_item
					on t_transaction.item_id = t_item.item_id
					LEFT JOIN t_unit
					ON t_item.unit_id = t_unit.unit_id
                    LEFT JOIN t_highlight
					ON t_item.highlight_id = t_highlight.highlight_id
					WHERE t_invoice.invoice_date = ?
					ORDER BY t_item.item_name ASC";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(1, $this->transactionDate);
		
		$stmt->execute();
		
		return $stmt;
	}
	
	public function countItem() {
		$query = "SELECT
					COUNT(t_transaction.item_id) as countItem
					FROM " . $this->tableName . "
					LEFT JOIN t_invoice
					ON t_transaction.transaction_code = t_invoice.invoice_code
					LEFT JOIN t_item
					on t_transaction.item_id = t_item.item_id
					LEFT JOIN t_unit
					ON t_item.unit_id = t_unit.unit_id
                    LEFT JOIN t_highlight
					ON t_item.highlight_id = t_highlight.highlight_id
					WHERE t_invoice.invoice_date=:invoice_date
					AND t_transaction.item_id=:item_id
					ORDER BY t_item.item_name ASC";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':invoice_date', $this->invoiceDate);
		$stmt->bindParam(':item_id', $this->itemId);
		
		$stmt->execute();
		
		return $stmt;
	}
}

?>