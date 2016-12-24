<?php

class Item {
    
    private $conn;
    private $tableName = 't_item';
    
    public $itemId;
    public $itemCode;
    public $itemName;
    public $categoryId;
    public $unitId;
    public $price;
    public $onQty;
    public $description;
    public $highlightId;
    public $realPrice;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    public function create(){
        
        // query insert new record
        $query = "INSERT INTO " . $this->tableName . "
                    SET 
                 item_name=:item_name, category_id=:category_id, unit_id=:unit_id, price=:price, onqty=:onqty, description=:description, real_price=:real_price, highlight_id=:highlight_id";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // bind values
        $stmt->bindParam(':item_name', $this->itemName);
        $stmt->bindParam(':category_id', $this->categoryId);
        $stmt->bindParam(':unit_id', $this->unitId);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':onqty', $this->onQty);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':real_price', $this->realPrice);
        $stmt->bindParam(':highlight_id', $this->highlightId);
        
        //execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    public function index($position, $offset){
        // query to show 
        if($_GET['q'] != NULL){
			$query = "SELECT t_item.item_id, t_item.item_name, t_category.category_name, t_item.onqty, t_unit.unit_name, t_item.price, t_item.description, t_highlight.highlight_name FROM " . $this->tableName . " 
                  LEFT JOIN t_category
                  ON t_item.category_id = t_category.category_id
                  LEFT JOIN t_unit
                  ON t_item.unit_id = t_unit.unit_id
				  LEFT JOIN t_highlight
				  ON t_item.highlight_id = t_highlight.highlight_id
				  WHERE
				  t_item.item_name LIKE CONCAT('%', :item_name, '%')
				  OR
				  t_category.category_name LIKE CONCAT('%', :category_name, '%')
				  OR
				  t_unit.unit_name LIKE CONCAT('%', :unit_name, '%')
				  OR
				  t_highlight.highlight_name LIKE CONCAT('%', :highlight_name, '%')
                  ORDER BY t_item.item_id ASC
				  LIMIT $position, $offset";
		} else {
			$query = "SELECT t_item.item_id, t_item.item_name, t_category.category_name, t_item.onqty, t_unit.unit_name, t_item.price, t_item.description, t_highlight.highlight_name FROM " . $this->tableName . " 
                  LEFT JOIN t_category
                  ON t_item.category_id = t_category.category_id
                  LEFT JOIN t_unit
                  ON t_item.unit_id = t_unit.unit_id
				  LEFT JOIN t_highlight
				  ON t_item.highlight_id = t_highlight.highlight_id
                  ORDER BY t_item.item_id ASC
				  LIMIT $position, $offset";
		}
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
		$stmt->bindParam(':item_name', $_GET['q']);
		$stmt->bindParam(':category_name', $_GET['q']);
		$stmt->bindParam(':unit_name', $_GET['q']);
		$stmt->bindParam(':highlight_name', $_GET['q']);
        // execute query
        $stmt->execute();
        
        return $stmt;
    }
    
    public function indexAll(){
        // query to show 
        $query = "SELECT t_item.item_id, t_item.item_name, t_category.category_name, t_item.onqty, t_unit.unit_name, t_item.price, t_item.description, t_highlight.highlight_name FROM " . $this->tableName . " 
                  LEFT JOIN t_category
                  ON t_item.category_id = t_category.category_id
                  LEFT JOIN t_unit
                  ON t_item.unit_id = t_unit.unit_id
				  LEFT JOIN t_highlight
				  ON t_item.highlight_id = t_highlight.highlight_id
                  ORDER BY t_item.item_id ASC";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }
    
    public function showOne(){
        // query
        $query = "SELECT * FROM " . $this->tableName . " where item_id = ?";
        
        // prepare statement
        $stmt = $this->conn->prepare($query);
        
        // bind values
        $stmt->bindParam(1, $this->itemId);
        
        // execute query
        $stmt->execute();
        
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        
        // set values to object properties
        $this->itemName = $row->item_name;
        $this->categoryId = $row->category_id;
        $this->unitId = $row->unit_id;
        $this->price = $row->price;
        $this->onqty = $row->onqty;
        $this->description = $row->description;
        $this->highlightId = $row->highlight_id;
        $this->realPrice = $row->real_price;
    }
    
    public function readOne(){
        // query
        $query = "SELECT t_item.item_id, t_item.item_name, t_category.category_name, t_item.onqty, t_unit.unit_name, t_item.price, t_item.description, t_highlight.highlight_name FROM " . $this->tableName . " 
                  LEFT JOIN t_category
                  ON t_item.category_id = t_category.category_id
                  LEFT JOIN t_unit
                  ON t_item.unit_id = t_unit.unit_id
				  LEFT JOIN t_highlight
				  ON t_item.highlight_id = t_highlight.highlight_id
                  WHERE t_item.item_id = ?
                  ORDER BY t_item.item_id ASC";
        
        // prepare statement
        $stmt = $this->conn->prepare($query);
        
        // bind values
        $stmt->bindParam(1, $this->itemId);
        
        // execute query
        $stmt->execute();
        
        // get retrieved row
        return $stmt;
    }
    
    public function update(){
        //query
        $query = "UPDATE " . $this->tableName . " SET
                    item_name=:item_name,
                    category_id=:category_id,
                    unit_id=:unit_id,
                    price=:price,
                    onqty=:onqty,
                    description=:description,
                    real_price=:real_price,
                    highlight_id=:highlight_id
                    WHERE item_id =:item_id
                    ";
            
        // prepare statement
        $stmt = $this->conn->prepare($query);
        
        // bind values
        $stmt->bindParam(':item_name', $this->itemName);
        $stmt->bindParam(':category_id', $this->categoryId);
        $stmt->bindParam(':unit_id', $this->unitId);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':onqty', $this->onQty);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':real_price', $this->realPrice);
        $stmt->bindParam(':highlight_id', $this->highlightId);
        $stmt->bindParam(':item_id', $this->itemId);
        
        // execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    public function delete(){
        // query
        $query = "DELETE FROM " . $this->tableName . " WHERE item_id = ?";
        
        // prepare statement
        $stmt = $this->conn->prepare($query);
        
        // bind values
        $stmt->bindParam(1, $this->itemId);
        
        // execute query
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
	
	public function getUnit(){
		// query
		$query = "SELECT t_unit.unit_name
				  FROM t_item
				  LEFT JOIN t_unit
				  ON t_item.unit_id = t_unit.unit_id
				  WHERE t_item.item_id =:item_id
				  LIMIT 0,1";
		
		// prepare
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':item_id', $this->itemId);
		
		// execute
		$stmt->execute();
		
		return $stmt;
	}
    
    public function getItemPrice(){
        $query = "SELECT real_price FROM " . $this->tableName . "
                  WHERE item_id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->itemId);
        
        $stmt->execute();
        
        return $stmt;
    }
}