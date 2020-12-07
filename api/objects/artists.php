<?php
class Artist{
	private $conn;
	private $table_name = "artist";

    public $E_name;
    public $E_date;
    public $Type;
	public $F_name;
	public $L_name;
    public $UCID;



	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " a
                ORDER BY
                    a.E_date DESC";
  
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
                    E_name=:E_name, E_date=:E_date, Type=:Type, F_name=:F_name, L_name=:L_name, UCID=:UCID";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->E_name=htmlspecialchars(strip_tags($this->E_name));
        $this->E_date=htmlspecialchars(strip_tags($this->E_date));
        $this->Type=htmlspecialchars(strip_tags($this->Type));
        $this->F_name=htmlspecialchars(strip_tags($this->F_name));
        $this->L_name=htmlspecialchars(strip_tags($this->L_name));
        $this->UCID=htmlspecialchars(strip_tags($this->UCID));
  
        $this->L_name = $this->L_name ? $this->L_name : null;
        $this->UCID = $this->UCID ? $this->UCID : null;
        // bind values
        $stmt->bindParam(":E_name", $this->E_name);
        $stmt->bindParam(":E_date", $this->E_date);
        $stmt->bindParam(":Type", $this->Type);
        $stmt->bindParam(":F_name", $this->F_name);
        $stmt->bindParam(":L_name", $this->L_name);
        $stmt->bindParam(":UCID", $this->UCID);

  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
      
    }


    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE E_name = ? AND E_date = ? AND Type = ? AND F_name = ?" ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->E_name=htmlspecialchars(strip_tags($this->E_name));
        $this->E_date=htmlspecialchars(strip_tags($this->E_date));
        $this->Type=htmlspecialchars(strip_tags($this->Type));
        $this->F_name=htmlspecialchars(strip_tags($this->F_name));
  
        // bind id of record to delete
        $stmt->bindParam(1, $this->E_name);
        $stmt->bindParam(2, $this->E_date);
        $stmt->bindParam(3, $this->Type);
        $stmt->bindParam(4, $this->F_name);


  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>