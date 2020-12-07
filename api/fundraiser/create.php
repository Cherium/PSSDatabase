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
include_once '../objects/fundraisers.php';
  
$database = new Database();
$db = $database->getConnection();
  
$fundraiser = new Fundraiser($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->Name) &&
    !empty($data->Transaction_no) 
){
  
    // set product property values
    $fundraiser->Name = $data->Name;
    $fundraiser->Transaction_no = $data->Transaction_no;



  
    // create the product
    if($fundraiser->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Fundraiser was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create fundraiser. Choose a unique fundraiser for the event or check that event is entered correctly."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create fundraiser. Data is incomplete."));
}
?>