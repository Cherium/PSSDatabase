<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/members.php';
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare product object
    $member = new Member($db);
  
    // get id of product to be edited
    $data = json_decode(file_get_contents("php://input"));
  
    // set ID property of product to be edited
    $member->UCID = $data->UCID;

  
    // set product property values
    $member->Int_stat = $data->Int_stat;
    $member->Email = $data->Email;
    $member->Year_of_study = $data->Year_of_study;
    $member->Program = $data->Program;
    $member->Subscription_status = $data->Subscription_status;
    $member->Transaction_no = $data->Transaction_no;
  
    
    // update the product
    if($member->update()){
  
        // set response code - 200 ok
        http_response_code(200);
  
        // tell the user
        echo json_encode(array("message" => "Member was updated."));
    }
  
    // if unable to update the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to update member."));
    }
?>