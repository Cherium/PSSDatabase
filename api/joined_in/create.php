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
include_once '../objects/joined_ins.php';
  
$database = new Database();
$db = $database->getConnection();
  
$joined_in = new Joined_in($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->E_name) &&
    !empty($data->E_date) &&
    !empty($data->UCID)
){
  
    // set product property values
    $joined_in->E_name = $data->E_name;
    $joined_in->E_date = $data->E_date;
    $joined_in->UCID = $data->UCID;




  
    // create the product
    if($joined_in->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Joined_in was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create joined_in. Check input data."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create joined_in. Data is incomplete."));
}
?>