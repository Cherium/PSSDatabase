<?php
class President{
	private $conn;
	private $table_name = "president";

    public $UCID;
    public $Date_elected;



	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " p
                ORDER BY
                    p.Date_elected DESC";
  
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
                    UCID=:UCID, Date_elected=:Date_elected";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->UCID=htmlspecialchars(strip_tags($this->UCID));
        $this->Date_elected=htmlspecialchars(strip_tags($this->Date_elected));

        // bind values
        $stmt->bindParam(":UCID", $this->UCID);
        $stmt->bindParam(":Date_elected", $this->Date_elected);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }


    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE UCID = ? AND Date_elected = ? " ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->UCID=htmlspecialchars(strip_tags($this->UCID));
        $this->Date_elected=htmlspecialchars(strip_tags($this->Date_elected));

  
        // bind id of record to delete
        $stmt->bindParam(1, $this->UCID);
        $stmt->bindParam(2, $this->Date_elected);



  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>