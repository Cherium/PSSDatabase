<?php
class Sponsorship{
	private $conn;
	private $table_name = "sponsorship";

    public $Transaction_no;
    public $Package_type;
    public $Sponsor_name;
    public $Sponsor_package;



	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " s
                ORDER BY
                    s.Sponsor_name DESC";
  
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
                    Transaction_no=:Transaction_no, Package_type=:Package_type, Sponsor_name=:Sponsor_name, Sponsor_package=:Sponsor_package";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Package_type=htmlspecialchars(strip_tags($this->Package_type));
        $this->Sponsor_name=htmlspecialchars(strip_tags($this->Sponsor_name));
        $this->Sponsor_package=htmlspecialchars(strip_tags($this->Sponsor_package));

        // bind values
        $stmt->bindParam(":Transaction_no", $this->Transaction_no);
        $stmt->bindParam(":Package_type", $this->Package_type);
        $stmt->bindParam(":Sponsor_name", $this->Sponsor_name);
        $stmt->bindParam(":Sponsor_package", $this->Sponsor_package);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }


    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE Transaction_no = ? AND Package_type = ? AND Sponsor_name = ? AND Sponsor_package = ? " ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Package_type=htmlspecialchars(strip_tags($this->Package_type));
        $this->Sponsor_name=htmlspecialchars(strip_tags($this->Sponsor_name));
        $this->Sponsor_package=htmlspecialchars(strip_tags($this->Sponsor_package));

  
        // bind id of record to delete
        $stmt->bindParam(1, $this->Transaction_no);
        $stmt->bindParam(2, $this->Package_type);
        $stmt->bindParam(3, $this->Sponsor_name);
        $stmt->bindParam(4, $this->Sponsor_package);



  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>