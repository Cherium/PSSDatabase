<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/reimbursements.php';
  
$database = new Database();
$db = $database->getConnection();
  
$reimbursement = new Reimbursement($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->UCID) &&
    !empty($data->Transaction_no) 
){
  
    // set product property values
    $reimbursement->UCID = $data->UCID;
    $reimbursement->Transaction_no = $data->Transaction_no;


  
    // create the product
    if($reimbursement->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Reimbursement was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the x
        echo json_encode(array("message" => "Unable to create reimbursement. Make sure UCID is an existing executive and there is a valid outgoing transaction number."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create reimbursement. Data is incomplete."));
}
?>