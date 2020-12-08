<?php
class Author{
	private $conn;
	private $table_name = "author";

	public $UCID;
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
                    UCID=:UCID, Date=:Date";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->UCID=htmlspecialchars(strip_tags($this->UCID));
        $this->Date=htmlspecialchars(strip_tags($this->Date));

        
        // bind values
        $stmt->bindParam(":UCID", $this->UCID);
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
                WHERE UCID = ? AND Date = ?" ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->UCID=htmlspecialchars(strip_tags($this->UCID));
        $this->Date=htmlspecialchars(strip_tags($this->Date));

        
        // bind id of record to delete
        $stmt->bindParam(1, $this->UCID);
        $stmt->bindParam(2, $this->Date);

        

  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>