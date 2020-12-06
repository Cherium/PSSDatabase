<?php
class Performance{
	private $conn;
	private $table_name = "performance";

	public $E_name;
	public $E_date;
	public $Type;


	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " p
                ORDER BY
                    p.E_date DESC";
  
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
                    E_name=:E_name, E_date=:E_date, Type=:Type";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->E_name=htmlspecialchars(strip_tags($this->E_name));
        $this->E_date=htmlspecialchars(strip_tags($this->E_date));
        $this->Type=htmlspecialchars(strip_tags($this->Type));

  
        // bind values
        $stmt->bindParam(":E_name", $this->E_name);
        $stmt->bindParam(":E_date", $this->E_date);
        $stmt->bindParam(":Type", $this->Type);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }




    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE E_name = ? AND E_date = ? AND Type = ?" ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->E_name=htmlspecialchars(strip_tags($this->E_name));
        $this->E_date=htmlspecialchars(strip_tags($this->E_date));
        $this->Type=htmlspecialchars(strip_tags($this->Type));
  
        // bind id of record to delete
        $stmt->bindParam(1, $this->E_name);
        $stmt->bindParam(2, $this->E_date);
        $stmt->bindParam(3, $this->Type);



  
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