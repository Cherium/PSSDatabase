<?php
class Monthly_email{
	private $conn;
	private $table_name = "monthly_email";

	public $Date;


	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " m
                ORDER BY
                    m.Date DESC";
  
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
                    Date=:Date";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Date=htmlspecialchars(strip_tags($this->Date));

  
        // bind values
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
                WHERE Date = ? " ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Date=htmlspecialchars(strip_tags($this->Date));

  
        // bind id of record to delete
        $stmt->bindParam(1, $this->Date);



  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>