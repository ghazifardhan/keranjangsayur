<?php

require_once 'Include.php';

class Paging {
    
	private $conn;
	
    public $page;
    public $offset;
    public $position;
    public $totalData;
    public $totalPage;
    
	public function __construct($db){
		$this->conn = $db;	
	}
	
    public function setTable($tableName) {
        $query = "SELECT * FROM " . $tableName . " LIMIT $this->position,$this->offset";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		
		return $stmt;
    }
    
    public function setPaging($param1, $param2) {
        if(empty($this->page))
        {
            $this->position = $param1;
            $this->page = $param2; //start from page 3
        } else
        {
            $this->position = ($this->page - 1) * $this->offset;
        }
    }
    
    public function setCount($tableName) {
        $query = "SELECT * FROM " . $tableName;
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		
		return $stmt;
    }
	
	public function createPaging($id) {
	?>
		<nav aria-label="Page Navigation">
        <center><ul class="pagination">
            <li class="<?php if($this->page == 1){echo 'disabled';} ?>"><a href="?page=<?php if($this->page > 1){echo $this->page - 1;} else {echo $this->page = 1;} ?>&view=<?php echo $id; ?>">&laquo;</a></li>
    <?php	 
    	for($i=1;$i<=$this->totalPage;$i++)
    	{
			if ((($i >= $this->page - 5) && ($i <= $this->page + 5))){
	?>			
            <li class="<?php if($i == $this->page) {echo 'active';} ?>"><a href="<?php echo "?page=$i&view=$id"; ?>"><?php echo $i; ?></a></li>
    <?php
		} 
		}
		$test = $this->totalPage - 1;
    ?>
            <li class="<?php if($this->page == $this->totalPage){echo 'disabled';} ?>"><a href="?page=<?php if($this->page == $this->totalPage){echo $this->page = $this->totalPage;} else {echo $this->page + 1;} ?>&view=<?php echo $id; ?>" class="disabled">&raquo;</a></li>
        </ul></center>
    </nav>
	<?php
	}
    
}

?>