<?php
class Event{
	private $conn;
    private $table_name = "Financial_Transaction";
    
    public $No;
    public $Date;
    public $Amount;
	
	

	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " t ";
              
  
        // prepare query statement, consider like a datagram packet(Stroring all the information needed to execute a certain query)
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
                    Transaction_no=:No, Date=:Date, Amount=:Amount";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->No=htmlspecialchars(strip_tags($this->No));
        $this->Date=htmlspecialchars(strip_tags($this->Date));
        $this->Amount=htmlspecialchars(strip_tags($this->Amount));
        
        // bind values
        $stmt->bindParam(":Transaction_no", $this->No);
        $stmt->bindParam(":Date", $this->Date);
        $stmt->bindParam(":Amount", $this->Amount);
        

  
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
                    " . $this->table_name . " t
                WHERE
                    t.Transaction_no = " . $this->No . " AND t.Date = " . $this->Date . "
                LIMIT
                    0,1";
  
        // prepare query statement
        $stmt = $this->conn->prepare( $query );


        // bind id of product to be updated
        $stmt->bindParam(1, $this->No);
        $stmt->bindParam(2, $this->Date);

     

  
        // execute query
        $stmt->execute();
  
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
        // set values to object properties
        $this->No = $row['Transaction_no'];
        $this->Date = $row['Date'];
        $this->Amount = $row['Amount'];
        

    }

    function update(){
  
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                     Amount=:Amount
                WHERE
                    Transaction_no=:No ";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->No = $row['Transaction_no'];
        $this->Date = $row['Date'];
        $this->Amount = $row['Amount'];

  
        // bind new values
        $stmt->bindParam(':Amount', $this->Amount);
        

  
        // execute the query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

    function delete(){

  
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                 WHERE
                    Transaction_no=:No ";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->No=htmlspecialchars(strip_tags($this->No));
       
  
        // bind id of record to delete
        $stmt->bindParam(":Transaction_no", $this->No);
        

       
        echo $this->Date;
  
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