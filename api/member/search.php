<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/members.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$member = new Member($db);
  
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
// query products
$stmt = $member->search($keywords);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $members_arr=array();
    $members_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $member_item=array(
            // same attributes as in read.php
            "UCID" => $UCID,
            "Int_stat" => $Int_stat,
            "Fname" => $Fname,
            "Lname" => $Lname,
            "Email" => $Email,
            "Year_of_study" => $Year_of_study,
            "Program" => $Program
        );
  
        array_push($members_arr["records"], $member_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data
    echo json_encode($members_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No members found.")
    );
}
?>