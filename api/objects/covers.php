<?php
class Cover{
	private $conn;
	private $table_name = "cover";

	public $Name;
	public $E_date;
	public $Date;

	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " e
                ORDER BY
                    e.Date DESC";
  
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
                    Name=:Name, E_date=:E_date, Date=:Date";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->E_date=htmlspecialchars(strip_tags($this->E_date));
        $this->Date=htmlspecialchars(strip_tags($this->Date));
  
        // bind values
        $stmt->bindParam(":Name", $this->Name);
        $stmt->bindParam(":E_date", $this->E_date);
        $stmt->bindParam(":Date", $this->Date);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }


    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE Name = ? AND E_date = ? AND Date = ?" ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->E_date=htmlspecialchars(strip_tags($this->E_date));
        $this->Date=htmlspecialchars(strip_tags($this->Date));
  
        // bind id of record to delete
        $stmt->bindParam(1, $this->Name);
        $stmt->bindParam(2, $this->E_date);
        $stmt->bindParam(3, $this->Date);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>