<?php
class Food{
	private $conn;
	private $table_name = "food";

	public $E_name;
	public $E_date;
	public $Food;

	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " f
                ORDER BY
                    f.E_date DESC";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // execute query
        $stmt->execute();
  
        return $stmt;
    }

    function create(){
  
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    E_name=:E_name, E_date=:E_date, Food=:Food";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->E_name=htmlspecialchars(strip_tags($this->E_name));
        $this->E_date=htmlspecialchars(strip_tags($this->E_date));
        $this->Food=htmlspecialchars(strip_tags($this->Food));
  
        // bind values
        $stmt->bindParam(":E_name", $this->E_name);
        $stmt->bindParam(":E_date", $this->E_date);
        $stmt->bindParam(":Food", $this->Food);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }


    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE E_name = ? AND E_date = ? AND Food = ?" ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->E_name=htmlspecialchars(strip_tags($this->E_name));
        $this->E_date=htmlspecialchars(strip_tags($this->E_date));
        $this->Food=htmlspecialchars(strip_tags($this->Food));
  
        // bind id of record to delete
        $stmt->bindParam(1, $this->E_name);
        $stmt->bindParam(2, $this->E_date);
        $stmt->bindParam(3, $this->Food);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>