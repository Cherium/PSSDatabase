<?php
class Member{
	private $conn;
	private $table_name = "member";

	public $UCID;
	public $Int_stat;
	public $Fname;
    public $Lname;
    public $Email;
    public $Year_of_study;
    public $Program;
    public $Subscription_status;
    public $Transaction_no;
    public $E_name;
    public $E_date;

	public function __construct($db){
		$this->conn = $db;
	}

	function read(){  
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . " m
                ORDER BY
                    m.Fname DESC";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // execute query
        $stmt->execute();
  
        return $stmt;
    }

    function create(){
        
        // query to insert record
        // Subscription and transaction status are going to be options in update instead of create
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    UCID=:UCID, Int_stat=:Int_stat, Fname=:Fname, Lname=:Lname, Email=:Email, Year_of_study=:Year_of_study, Program=:Program";
      
        //echo "???";
        // prepare query
        $stmt = $this->conn->prepare($query);

      
        // sanitize
        $this->UCID=(int)htmlspecialchars(strip_tags($this->UCID));

        $this->Int_stat=$this->Int_stat ? b'1' : b'0'; // https://stackoverflow.com/questions/12660756/to-deal-with-boolean-values-in-php-mysql

        //$this->Int_stat=(int)htmlspecialchars(strip_tags($this->Int_stat));
        $this->Fname=htmlspecialchars(strip_tags($this->Fname));
        $this->Lname=htmlspecialchars(strip_tags($this->Lname));
        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->Year_of_study=htmlspecialchars(strip_tags($this->Year_of_study));
        $this->Program=htmlspecialchars(strip_tags($this->Program));

        //$this->Subscription_status=$this->Subscription_status ? true : false;
        //$this->Subscription_status=htmlspecialchars(strip_tags($this->Subscription_status));

        //$thisTransaction_no=(int)htmlspecialchars(strip_tags($this->Transaction_no)) ? (int)htmlspecialchars(strip_tags($this->Transaction_no)) : NULL;
        //$this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
      
        
 
        // bind values
        $stmt->bindParam(":UCID", $this->UCID);
        $stmt->bindParam(":Int_stat", $this->Int_stat);
        $stmt->bindParam(":Fname", $this->Fname);
        $stmt->bindParam(":Lname", $this->Lname);
        $stmt->bindParam(":Email", $this->Email);
        $stmt->bindParam(":Year_of_study", $this->Year_of_study);
        $stmt->bindParam(":Program", $this->Program);
        //$stmt->bindParam(":Subscription_status", $this->Subscription_status);
        //$stmt->bindParam(":Transaction_no", $this->Transaction_no);
  
      
        // execute query
        if($stmt->execute()){
            return true;
        }
      
        return false;
      
    }
      
    // used to edit a member
    function readOne(){
      
      
      
        // query to read single record
        $query = "SELECT *                   
                FROM
                    " . $this->table_name . " m               
                WHERE
                    m.UCID = " . $this->UCID . " 
                LIMIT
                    0,1";
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
      
      
        // bind id of product to be updated
        $stmt->bindParam(1, $this->UCID);
      
      
      
      
      
        // execute query
        $stmt->execute();
      
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        // set values to object properties
        $this->UCID = $row['UCID'];
        $this->Int_stat = $row['Int_stat'];
        $this->Fname = $row['Fname'];
        $this->Lname = $row['Lname'];
        $this->Email = $row['Email'];
        $this->Year_of_study = $row['Year_of_study'];
        $this->Program = $row['Program'];
        $this->Subscription_status = $row['Subscription_status'];
        $this->Transaction_no = $row['Transaction_no'];
        //$this->E_name = $row['E_name'];
        //$this->E_date = $row['E_date'];
      
      
    }
      
    function update(){
        
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    Int_stat=:Int_stat, Email=:Email, Year_of_study=:Year_of_study, Program=:Program, Subscription_status=:Subscription_status, Transaction_no=:Transaction_no
                WHERE
                    UCID=:UCID";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->UCID=htmlspecialchars(strip_tags($this->UCID));
        $this->Int_stat=htmlspecialchars(strip_tags($this->Int_stat));
        $this->Int_stat= $this->Int_stat ? b'1' : b'0'; // https://stackoverflow.com/questions/7655423/how-can-i-update-the-boolean-values-in-mysql
        //$this->Fname=htmlspecialchars(strip_tags($this->Fname));
        //$this->Lname=htmlspecialchars(strip_tags($this->Lname));
        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->Year_of_study=htmlspecialchars(strip_tags($this->Year_of_study));
        $this->Program=htmlspecialchars(strip_tags($this->Program));
        echo $this->Subscription_status;
        $this->Subscription_status=htmlspecialchars(strip_tags($this->Subscription_status));
        $this->Subscription_status= $this->Subscription_status ? b'1' : b'0';
        $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));
        $this->Transaction_no= $this->Transaction_no ? $this->Transaction_no : NULL;
        
        
        

        // bind new values
        $stmt->bindParam(":UCID", $this->UCID);
        $stmt->bindParam(":Int_stat", $this->Int_stat);
        //$stmt->bindParam(":Fname", $this->Fname);
        //$stmt->bindParam(":Lname", $this->Lname);
        $stmt->bindParam(":Email", $this->Email);
        $stmt->bindParam(":Year_of_study", $this->Year_of_study);
        $stmt->bindParam(":Program", $this->Program);
        $stmt->bindParam(":Subscription_status", $this->Subscription_status);
        $stmt->bindParam(":Transaction_no", $this->Transaction_no);
      
      
      
        // execute the query
        if($stmt->execute()){
            return true;
        }
      
        return false;
    }
      
    function delete(){
      
      
        // delete query
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE UCID = ?" ;
      
        // prepare query
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->UCID=htmlspecialchars(strip_tags($this->UCID));
      
      
        // bind id of record to delete
        $stmt->bindParam(1, $this->UCID);
      
      
        // echo $this->UCID;
      
      
        // execute query
        if($stmt->execute()){
            return true;
        }
      
        return false;
    }
      
    // search products
    function search($keywords){
      
        // select all query
        // Searches members by program
        // Ideally, search by event that they joined in
        $query = "SELECT *
                FROM
                    " . $this->table_name . " m
                WHERE
                    m.Program LIKE ? 
                ORDER BY
                    m.Lname DESC";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
      
        // bind
        $stmt->bindParam(1, $keywords);
        //$stmt->bindParam(2, $keywords);
      
      
      
        // execute query
        $stmt->execute();
      
        return $stmt;
    }

   
}
?>