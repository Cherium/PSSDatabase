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
include_once '../objects/membership_payments.php';
  
$database = new Database();
$db = $database->getConnection();
  
$membership_payment = new Membership_payment($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->Transaction_no) &&
    !empty($data->Payment_status) 
){
  
    // set product property values
    $membership_payment->Transaction_no = $data->Transaction_no;
    $membership_payment->Payment_status = $data->Payment_status;

    



  
    // create the product
    if($membership_payment->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Membership_payment was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create membership_payment. Choose a unique membership_payment for the event or check that event is entered correctly."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create membership_payment. Data is incomplete."));
}
?>