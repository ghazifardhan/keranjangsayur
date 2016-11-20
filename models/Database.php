<?php
class Database{
     
    // akses ke database
    private $host = "localhost";
    private $dbName = "nsproject";
    private $username = "root";
    private $password = "";
    public $conn;
     
    // akses untuk koneksi database
    public function connectDB(){
     
        $this->conn = null;
         
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}
?>