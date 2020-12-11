<?php
class financial_transaction{
	private $conn;
    private $table_name = "financial_transaction";
    
    public $Transaction_no;
    public $Date;
    public $Amount;
	
	

	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " f ";
              
  
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
                    Transaction_no=:Transaction_no, Date=:Date, Amount=:Amount";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Date=htmlspecialchars(strip_tags($this->Date));
        $this->Amount=htmlspecialchars(strip_tags($this->Amount));
        
        // bind values
        $stmt->bindParam(":Transaction_no", $this->Transaction_no);
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
                    " . $this->table_name . " f
                WHERE
                    f.Transaction_no = " . $this->Transaction_no . " AND f.Date = " . $this->Date . "
                LIMIT
                    0,1";
  
        // prepare query statement
        $stmt = $this->conn->prepare( $query );


        // bind id of product to be updated
        $stmt->bindParam(1, $this->Transaction_no);
        $stmt->bindParam(2, $this->Date);

     

  
        // execute query
        $stmt->execute();
  
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
        // set values to object properties
        $this->Transaction_no = $row['Transaction_no'];
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
                    Transaction_no=:Transaction_no";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // sanitize

        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Amount=htmlspecialchars(strip_tags($this->Amount));        
        
        // bind new values
        $stmt->bindParam(':Transaction_no', $this->Transaction_no);
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
                    Transaction_no=:Transaction_no ";
  
        // prepare query
        $stmt = $this->conn->prepare($query);
  
        // sanitize
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
       
  
        // bind id of record to delete
        $stmt->bindParam(":Transaction_no", $this->Transaction_no);
        

       

  
        // execute query
        if($stmt->execute()){
            return true;
        }
  
        return false;
    }

   
}
?>