<?php
class Topic{
	private $conn;
	private $table_name = "topic";

    public $Date;
    public $Name;



	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " t
                ORDER BY
                    t.Date DESC";
  
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
                    Date=:Date, Name=:Name";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Date=htmlspecialchars(strip_tags($this->Date));
        $this->Name=htmlspecialchars(strip_tags($this->Name));

        // bind values
        $stmt->bindParam(":Date", $this->Date);
        $stmt->bindParam(":Name", $this->Name);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }


    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE Date = ? AND Name = ? " ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Date=htmlspecialchars(strip_tags($this->Date));
        $this->Name=htmlspecialchars(strip_tags($this->Name));

  
        // bind id of record to delete
        $stmt->bindParam(1, $this->Date);
        $stmt->bindParam(2, $this->Name);



  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>