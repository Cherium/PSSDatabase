<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/budgets.php';
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare product object
    $budget = new Budget($db);
  
    // get id of product to be edited
    $data = json_decode(file_get_contents("php://input"));
  
    
    
    // set product property values
    $budget->Name = $data->Name;
    $budget->Date = $data->Date;
    $budget->Transaction_no = $data->Transaction_no;
    $budget->Food = $data->Food;
    $budget->Rent = $data->Rent;
    $budget->Decoration = $data->Decoration;
    $budget->Performer = $data->Performer;
    $budget->Other = $data->Other;


  
    // update the product
    if($budget->update()){
  
        // set response code - 200 ok
        http_response_code(200);
  
        // tell the user
        echo json_encode(array("message" => "Budget was updated."));
    }
  
    // if unable to update the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to update budget."));
    }
?>