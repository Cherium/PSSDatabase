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
include_once '../objects/sponsorships.php';
  
$database = new Database();
$db = $database->getConnection();
  
$sponsorship = new Sponsorship($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->Transaction_no) &&
    !empty($data->Package_type) &&
    !empty($data->Sponsor_name) &&
    !empty($data->Sponsor_package) 

){
  
    // set product property values
    $sponsorship->Transaction_no = $data->Transaction_no;
    $sponsorship->Package_type = $data->Package_type;
    $sponsorship->Sponsor_name = $data->Sponsor_name;
    $sponsorship->Sponsor_package = $data->Sponsor_package;

  
    // create the product
    if($sponsorship->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Sponsorship was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the x
        echo json_encode(array("message" => "Unable to create sponsorship. Make sure all fields are valid."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create sponsorship. Data is incomplete."));
}
?>