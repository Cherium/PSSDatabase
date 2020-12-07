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
include_once '../objects/artists.php';
  
$database = new Database();
$db = $database->getConnection();
  
$artist = new Artist($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->E_name) &&
    !empty($data->E_date) &&
    !empty($data->Type) &&
    !empty($data->F_name) 
){
  
    // set product property values
    $artist->E_name = $data->E_name;
    $artist->E_date = $data->E_date;
    $artist->Type = $data->Type;
    $artist->F_name = $data->F_name;
    $artist->L_name = $data->L_name;
    $artist->UCID = $data->UCID;

  
    // create the product
    if($artist->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Artist was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create artist. The same artist may be performing at the same event or data is inaccuracte."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create artist. Data is incomplete."));
}
?>