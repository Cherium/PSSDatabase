<?php
class Department{
	private $conn;
	private $table_name = "department";

    public $Name;
    public $H_UCID;




	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " a
                ORDER BY
                    a.Name ASC";
  
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
                    Name=:Name, H_UCID=:H_UCID";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->H_UCID=htmlspecialchars(strip_tags($this->H_UCID));


        // bind values
        $stmt->bindParam(":Name", $this->Name);
        $stmt->bindParam(":H_UCID", $this->H_UCID);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }


    function update(){

  
        // delete query
        $query = "UPDATE 
                    " . $this->table_name . " 
                SET 
                    H_UCID=:H_UCID
                WHERE 
                    Name=:Name " ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->H_UCID=htmlspecialchars(strip_tags($this->H_UCID));

  
        // bind id of record to delete
        $stmt->bindParam(":Name", $this->Name);
        $stmt->bindParam(":H_UCID", $this->H_UCID);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>