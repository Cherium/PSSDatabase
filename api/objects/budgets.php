<?php
class Budget{
	private $conn;
	private $table_name = "budget";

	public $Name;
    public $Date;
	public $Transaction_no;
	public $Food;
	public $Rent;
    public $Decoration;
	public $Performer;
    public $Other;

	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " b
                ORDER BY
                    b.Date DESC";
  
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
                    Name=:Name, Date=:Date, Transaction_no=:Transaction_no, Food=:Food, Rent=:Rent, Decoration=:Decoration, Performer=:Performer, Other=:Other";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Date=htmlspecialchars(strip_tags($this->Date));
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Food=htmlspecialchars(strip_tags($this->Food));
        $this->Rent=htmlspecialchars(strip_tags($this->Rent));
        $this->Decoration=htmlspecialchars(strip_tags($this->Decoration));
        $this->Performer=htmlspecialchars(strip_tags($this->Performer));
        $this->Other=htmlspecialchars(strip_tags($this->Other));
  
        // bind values
        $stmt->bindParam(":Name", $this->Name);
        $stmt->bindParam(":Date", $this->Date);
        $stmt->bindParam(":Transaction_no", $this->Transaction_no);
        $stmt->bindParam(":Food", $this->Food);
        $stmt->bindParam(":Rent", $this->Rent);
        $stmt->bindParam(":Decoration", $this->Decoration);
        $stmt->bindParam(":Performer", $this->Performer);
        $stmt->bindParam(":Other", $this->Other);

  
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
                    Food=:Food, Rent=:Rent, Decoration=:Decoration, Performer=:Performer, Other=:Other
                WHERE
                    Name=:Name AND Date=:Date";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Date=htmlspecialchars(strip_tags($this->Date));
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Food=htmlspecialchars(strip_tags($this->Food));
        $this->Rent=htmlspecialchars(strip_tags($this->Rent));
        $this->Decoration=htmlspecialchars(strip_tags($this->Decoration));
        $this->Performer=htmlspecialchars(strip_tags($this->Performer));
        $this->Other=htmlspecialchars(strip_tags($this->Other));

  
        // bind new values
        $stmt->bindParam(':Name', $this->Name);
        $stmt->bindParam(':Date', $this->Date);
        //$stmt->bindParam(':Transaction_no', $this->Transaction_no);
        $stmt->bindParam(':Food', $this->Food);
        $stmt->bindParam(':Rent', $this->Rent);
        $stmt->bindParam(':Decoration', $this->Decoration);
        $stmt->bindParam(':Performer', $this->Performer);
        $stmt->bindParam(':Other', $this->Other);

  
        // execute the query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE Name = ? AND Date = ? AND Transaction_no = ?" ;
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Date=htmlspecialchars(strip_tags($this->Date));
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
  
        // bind id of record to delete
        $stmt->bindParam(1, $this->Name);
        $stmt->bindParam(2, $this->Date);
        $stmt->bindParam(3, $this->Transaction_no);

  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

}
?>