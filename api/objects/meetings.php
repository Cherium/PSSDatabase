<?php
class Meeting{
	private $conn;
	private $table_name = "meeting";

	public $Date;
	public $Summary;
	public $Department;
	

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
                    Date=:Date, Summary=:Summary, Department=:Department";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Date=htmlspecialchars(strip_tags($this->Date));
        $this->Summary=htmlspecialchars(strip_tags($this->Summary));
        $this->Department=htmlspecialchars(strip_tags($this->Department));

  
        // bind values
        $stmt->bindParam(":Date", $this->Date);
        $stmt->bindParam(":Summary", $this->Summary);
        $stmt->bindParam(":Department", $this->Department);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }

    // used when filling up the update product form
    function readOne(){
  


        // query to read single record
        $query = "SELECT *                   
                FROM
                    " . $this->table_name . " m
                WHERE
                    m.Date = " . $this->Date . "  
                LIMIT
                    0,1";
  
        // prepare query statement
        $stmt = $this->conn->prepare( $query );


        // bind id of product to be updated
        $stmt->bindParam(1, $this->Date);


     

  
        // execute query
        $stmt->execute();
  
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
        // set values to object properties
        $this->Date = $row['Date'];
        $this->Summary = $row['Summary'];
        $this->Department = $row['Department'];

    }

    function update(){
  
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    Summary=:Summary, Department=:Department
                WHERE
                    Date=:Date";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Date=htmlspecialchars(strip_tags($this->Date));
        $this->Summary=htmlspecialchars(strip_tags($this->Summary));
        $this->Department=htmlspecialchars(strip_tags($this->Department));

  
        // bind new values
        $stmt->bindParam(':Date', $this->Date);
        $stmt->bindParam(':Summary', $this->Summary);
        $stmt->bindParam(':Department', $this->Department);

  
        // execute the query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE Date = ?" ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Date=htmlspecialchars(strip_tags($this->Date));
  
        // bind id of record to delete
        $stmt->bindParam(1, $this->Date);

        //echo $this->Name;
        //echo $this->Date;
  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

        // search products
    function search($keywords){
  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " m
                WHERE
                    m.Department LIKE ?
                ORDER BY
                    m.Date DESC";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
  
        // bind
        $stmt->bindParam(1, $keywords);


  
        // execute query
        $stmt->execute();
  
        return $stmt;
    }
}
?>