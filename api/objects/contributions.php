<?php
class Contribution{
	private $conn;
	private $table_name = "contribution";

	public $Name;
	public $Transaction_no;

	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " c
                ORDER BY
                    c.Transaction_no ASC";
  
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
                    Name=:Name, Transaction_no=:Transaction_no";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));

        
        // bind values
        $stmt->bindParam(":Name", $this->Name);
        $stmt->bindParam(":Transaction_no", $this->Transaction_no);

        

  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }


    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE 
                    Name = ? AND Transaction_no = ?" ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));

        
        // bind id of record to delete
        $stmt->bindParam(1, $this->Name);
        $stmt->bindParam(2, $this->Transaction_no);

        

  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>