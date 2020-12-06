<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/meetings.php';
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare product object
    $meeting = new Meeting($db);
  
    // get id of product to be edited
    $data = json_decode(file_get_contents("php://input"));
  
    // set ID property of product to be edited
    $meeting->Date = $data->Date;
  
    // set product property values
    //$meeting->Date = $data->Date;
    $meeting->Summary = $data->Summary;
    $meeting->Department = $data->Department;
  
    // update the product
    if($meeting->update()){
  
        // set response code - 200 ok
        http_response_code(200);
  
        // tell the user
        echo json_encode(array("message" => "Meeting was updated."));
    }
  
    // if unable to update the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to update meeting."));
    }
?>