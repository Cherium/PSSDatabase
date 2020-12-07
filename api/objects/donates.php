<?php
class Donate{
	private $conn;
	private $table_name = "donate";

	public $UCID;
	public $Transaction_no;

	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " d
                ORDER BY
                    d.Transaction_no ASC";
  
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
                    UCID=:UCID, Transaction_no=:Transaction_no";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->UCID=htmlspecialchars(strip_tags($this->UCID));
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));

        
        // bind values
        $stmt->bindParam(":UCID", $this->UCID);
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
                    UCID = ? AND Transaction_no = ?" ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->UCID=htmlspecialchars(strip_tags($this->UCID));
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));

        
        // bind id of record to delete
        $stmt->bindParam(1, $this->UCID);
        $stmt->bindParam(2, $this->Transaction_no);

        

  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>