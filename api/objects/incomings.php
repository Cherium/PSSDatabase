<?php
class Incoming{
	private $conn;
	private $table_name = "incoming";

	public $Transaction_no;
	public $Package_type;


	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " i
                ORDER BY
                    i.Transaction_no ASC";
  
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
                    Transaction_no=:Transaction_no, Package_type=:Package_type";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Package_type=htmlspecialchars(strip_tags($this->Package_type));
  
        // bind values
        $stmt->bindParam(":Transaction_no", $this->Transaction_no);
        $stmt->bindParam(":Package_type", $this->Package_type);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }


    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE Transaction_no = ?" ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
  
        // bind id of record to delete
        $stmt->bindParam(1, $this->Transaction_no);


  
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
                    Package_type=:Package_type
                WHERE
                    Transaction_no=:Transaction_no";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Package_type=htmlspecialchars(strip_tags($this->Package_type));

  
        // bind new values
        $stmt->bindParam(':Transaction_no', $this->Transaction_no);
        $stmt->bindParam(':Package_type', $this->Package_type);

  
        // execute the query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }


}
?>