<?php
class Attendence{
	private $conn;
	private $table_name = "attendence";

    public $Date;
    public $UCID;




	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " a
                ORDER BY
                    a.Date DESC";
  
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
                Date=:Date, UCID=:UCID";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Date=htmlspecialchars(strip_tags($this->Date));
        $this->UCID=htmlspecialchars(strip_tags($this->UCID));


        // bind values
        $stmt->bindParam(":Date", $this->Date);
        $stmt->bindParam(":UCID", $this->UCID);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }


    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE Date = ? AND UCID = ? " ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Date=htmlspecialchars(strip_tags($this->Date));
        $this->UCID=htmlspecialchars(strip_tags($this->UCID));

  
        // bind id of record to delete
        $stmt->bindParam(1, $this->Date);
        $stmt->bindParam(2, $this->UCID);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>