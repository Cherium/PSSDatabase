<?php
class Outgoing{
	private $conn;
	private $table_name = "outgoing";

	public $Transaction_no;
	public $Type_of_transfer;


	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " o
                ORDER BY
                    o.Transaction_no ASC";
  
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
                    Transaction_no=:Transaction_no, Type_of_transfer=:Type_of_transfer";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Type_of_transfer=htmlspecialchars(strip_tags($this->Type_of_transfer));
  
        // bind values
        $stmt->bindParam(":Transaction_no", $this->Transaction_no);
        $stmt->bindParam(":Type_of_transfer", $this->Type_of_transfer);


  
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
                    Type_of_transfer=:Type_of_transfer
                WHERE
                    Transaction_no=:Transaction_no";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Type_of_transfer=htmlspecialchars(strip_tags($this->Type_of_transfer));

  
        // bind new values
        $stmt->bindParam(':Transaction_no', $this->Transaction_no);
        $stmt->bindParam(':Type_of_transfer', $this->Type_of_transfer);

  
        // execute the query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }


}
?>