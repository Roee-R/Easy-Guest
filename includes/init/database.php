<?php
    
require_once('config.php');

class Database{
    
    private $connection;
    
    function __construct(){
        $this->open_db_connection();
    }
    public function open_db_connection(){
        
        $this->connection=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if($this->connection->connect_error){
            die("Connection failed: ".$this->connection->connect_error);
        }
        else{
        }
    }
    public function get_connection(){
        return $this->connection;
    }
    public function query($sql){
        $result=$this->connection->query($sql);
        if(!$result){
            echo "<script type='text/javascript'>alert('something get wrong'.<br>. $sql);</script>";
        }
        else{
            return $result;
        }
    }
}
    $database=new Database();

?>