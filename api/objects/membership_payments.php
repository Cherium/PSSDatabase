<?php
class Membership_payment{
	private $conn;
	private $table_name = "membership_payment";

    public $Transaction_no;
    public $Payment_status;





	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " m
                ORDER BY
                    m.Transaction_no ASC";
  
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
                    Transaction_no=:Transaction_no, Payment_status=:Payment_status";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Payment_status=htmlspecialchars(strip_tags($this->Payment_status));

        

        // bind values
        $stmt->bindParam(":Transaction_no", $this->Transaction_no);
        $stmt->bindParam(":Payment_status", $this->Payment_status);

        

  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }


    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE Transaction_no = ? AND Payment_status = ?" ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Payment_status=htmlspecialchars(strip_tags($this->Payment_status));

        
        
        // bind id of record to delete
        $stmt->bindParam(1, $this->Transaction_no);
        $stmt->bindParam(2, $this->Payment_status);

        
        
  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>