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
include_once '../objects/financial_transaction.php';
  
$database = new Database();
$db = $database->getConnection();
  
$financial_transaction = new financial_transaction($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->Transaction_no) &&
    !empty($data->Date) 
){
  
    // set product property values
    $financial_transaction->Transaction_no = $data->Transaction_no;
    $financial_transaction->Date = $data->Date;
    $financial_transaction->Amount = $data->Amount;
    

  
    // create the product
    if($financial_transaction->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Financial transaction was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create financial transaction."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create financial transaction. Data is incomplete."));
}
?>