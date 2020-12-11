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
include_once '../objects/budgets.php';
  
$database = new Database();
$db = $database->getConnection();
  
$budget = new Budget($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->Name) &&
    !empty($data->Date) &&
    !empty($data->Transaction_no)
){
  
    // set product property values
    $budget->Name = $data->Name;
    $budget->Date = $data->Date;
    $budget->Transaction_no = $data->Transaction_no;
    $budget->Food = $data->Food;
    $budget->Rent = $data->Rent;
    $budget->Decoration = $data->Decoration;
    $budget->Performer = $data->Performer;
    $budget->Other = $data->Other;


  
    // create the product
    if($budget->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Budget was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create budget. Check that event for budget exists."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create budget. Data is incomplete."));
}
?>