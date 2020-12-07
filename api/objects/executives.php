<?php
class Executive{
	private $conn;
	private $table_name = "executive";

	public $EUCID;
	public $Date_elected;
	public $Dname;


	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " e
                ORDER BY
                    e.Dname DESC";
  
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
                    EUCID=:EUCID, Date_elected=:Date_elected, Dname=:Dname";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->EUCID=htmlspecialchars(strip_tags($this->EUCID));
        $this->Date_elected=htmlspecialchars(strip_tags($this->Date_elected));
        $this->Dname=htmlspecialchars(strip_tags($this->Dname));

        
        // bind values
        $stmt->bindParam(":EUCID", $this->EUCID);
        $stmt->bindParam(":Date_elected", $this->Date_elected);
        $stmt->bindParam(":Dname", $this->Dname);

        
  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }


    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE EUCID = ? " ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->EUCID=htmlspecialchars(strip_tags($this->EUCID));

        
        // bind id of record to delete
        $stmt->bindParam(1, $this->EUCID);


  
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
                    " . $this->table_name . " e
                WHERE
                    e.Name LIKE ? OR e.Location LIKE ? OR e.FundraiserName LIKE ?
                ORDER BY
                    e.Date DESC";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
  
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

  
        // execute query
        $stmt->execute();
  
        return $stmt;
    }
}
?>