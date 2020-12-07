<?php
class E_host{
	private $conn;
	private $table_name = "e_host";

    public $Name;
    public $Date;
    public $UCID;




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
                    Name=:Name, Date=:Date, UCID=:UCID";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Date=htmlspecialchars(strip_tags($this->Date));
        $this->UCID=htmlspecialchars(strip_tags($this->UCID));


        // bind values
        $stmt->bindParam(":Name", $this->Name);
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
                WHERE Name = ? AND Date = ?" ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Date=htmlspecialchars(strip_tags($this->Date));

        
        // bind id of record to delete
        $stmt->bindParam(1, $this->Name);
        $stmt->bindParam(2, $this->Date);

        
  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>