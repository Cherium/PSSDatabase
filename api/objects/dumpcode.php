function create(){
  
  // query to insert record
  // TODO: insert into joined_in table as well
  // maybe as a different php file
  $query = "INSERT INTO
              " . $this->table_name . "
          SET
              UCID=:UCID, Internation_status=:Internation_status, Fname=:Fname, Lname=:Lname, Email=:Email, Year_of_study=:Year_of_study, Program=:Program, Subscription_status=:Subscription_status,Transaction_no=:Transaction_no";

  // prepare query
  $stmt = $this->conn->prepare($query);

  // sanitize
  $this->UCID=htmlspecialchars(strip_tags($this->UCID));
  $this->Internation_status=htmlspecialchars(strip_tags($this->Internation_status));
  $this->Fname=htmlspecialchars(strip_tags($this->Fname));
  $this->Lname=htmlspecialchars(strip_tags($this->Lname));
  $this->Email=htmlspecialchars(strip_tags($this->Email));
  $this->Year_of_study=htmlspecialchars(strip_tags($this->Year_of_study));
  $this->Program=htmlspecialchars(strip_tags($this->Program));
  $this->Subscription_status=htmlspecialchars(strip_tags($this->Subscription_status));
  $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));

  // bind values
  $stmt->bindParam(":UCID", $this->UCID);
  $stmt->bindParam(":Internation_status", $this->Internation_status);
  $stmt->bindParam(":Fname", $this->Fname);
  $stmt->bindParam(":Lname", $this->Lname);
  $stmt->bindParam(":Email", $this->Email);
  $stmt->bindParam(":Year_of_study", $this->Year_of_study);
  $stmt->bindParam(":Program", $this->Program);
  $stmt->bindParam(":Subscription_status", $this->Subscription_status);
  $stmt->bindParam(":Transaction_no", $this->Transaction_no);


  // execute query
  if($stmt->execute()){
      return true;
  }

  return false;

}

// used when filling up the update member form
function readOne(){



  // query to read single record
  $query = "SELECT                    
          FROM
              " . $this->table_name . " m JOIN joined_in j 
          ON m.UCID = j.UCID
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
  $this->Internation_status = $row['Internation_status'];
  $this->Fname = $row['Fname'];
  $this->Lname = $row['Lname'];
  $this->Email = $row['Email'];
  $this->Year_of_study = $row['Year_of_study'];
  $this->Program = $row['Program'];
  $this->Subscription_status = $row['Subscription_status'];
  $this->Transaction_no = $row['Transaction_no'];
  $this->E_name = $row['E_name'];
  $this->E_date = $row['E_date'];


}

function update(){

  // update query
  $query = "UPDATE
              " . $this->table_name . "
          SET
              Internation_status=:Internation_status, Fname=:Fname, Lname=:Lname, Email=:Email, Year_of_study=:Year_of_study, Program=:Program, Subscription_status=:Subscription_status, Transaction_no=:Transaction_no
          WHERE
              UCID=:UCID";

  // prepare query statement
  $stmt = $this->conn->prepare($query);

  // sanitize
  $this->UCID=htmlspecialchars(strip_tags($this->UCID));
  $this->Internation_status=htmlspecialchars(strip_tags($this->Internation_status));
  $this->Fname=htmlspecialchars(strip_tags($this->Fname));
  $this->Lname=htmlspecialchars(strip_tags($this->Lname));
  $this->Email=htmlspecialchars(strip_tags($this->Email));
  $this->Year_of_study=htmlspecialchars(strip_tags($this->Year_of_study));
  $this->Program=htmlspecialchars(strip_tags($this->Program));
  $this->Subscription_status=htmlspecialchars(strip_tags($this->Subscription_status));
  $this->Transaction_no=htmlspecialchars(strip_tags($this->Transaction_no));

  // bind new values
  $stmt->bindParam(":UCID", $this->UCID);
  $stmt->bindParam(":Internation_status", $this->Internation_status);
  $stmt->bindParam(":Fname", $this->Fname);
  $stmt->bindParam(":Lname", $this->Lname);
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
  $query = "SELECT *
          FROM
              " . $this->table_name . " m
          WHERE
              m.Program LIKE ? OR m.Year LIKE ? 
          ORDER BY
              m.Lname DESC";

  // prepare query statement
  $stmt = $this->conn->prepare($query);

  // sanitize
  $keywords=htmlspecialchars(strip_tags($keywords));
  $keywords = "%{$keywords}%";

  // bind
  $stmt->bindParam(1, $keywords);
  $stmt->bindParam(2, $keywords);



  // execute query
  $stmt->execute();

  return $stmt;
}