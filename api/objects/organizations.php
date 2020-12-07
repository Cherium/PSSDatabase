<?php
class Organization{
	private $conn;
	private $table_name = "organization";

	public $Name;
	public $Contact;

	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " o
                ORDER BY
                    o.Name ASC";
  
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
                    Name=:Name, Contact=:Contact";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Contact=htmlspecialchars(strip_tags($this->Contact));

        
        // bind values
        $stmt->bindParam(":Name", $this->Name);
        $stmt->bindParam(":Contact", $this->Contact);

        

  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }

    function update(){
  
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    Contact=:Contact
                WHERE
                    Name=:Name";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Contact=htmlspecialchars(strip_tags($this->Contact));

        
  
        // bind new values
        $stmt->bindParam(':Name', $this->Name);
        $stmt->bindParam(':Contact', $this->Contact);
        //$stmt->bindParam(':Transaction_no', $this->Transaction_no);

  
        // execute the query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE Name = ? " ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        //$this->Contact=htmlspecialchars(strip_tags($this->Contact));

        
        // bind id of record to delete
        $stmt->bindParam(1, $this->Name);
        //$stmt->bindParam(2, $this->Contact);

        

  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>