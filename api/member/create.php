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
include_once '../objects/members.php';
  
$database = new Database();
$db = $database->getConnection();
  
$member = new Member($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->UCID) 
){
  
    // set product property values
    $member->UCID = $data->UCID;
    $member->Int_stat = $data->Int_stat;
    $member->Fname = $data->Fname;
    $member->Lname = $data->Lname;
    $member->Email = $data->Email;
    $member->Year_of_study = $data->Year_of_study;
    $member->Program = $data->Program;
    // Not existing by default, in update member
    //$member->Subscription_status = $data->Subscription_status;
    //$member->Transaction_no = $data->Transaction_no;


    
  
    // create the product
    if($member->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Member was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create member."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create member. Data is incomplete."));
}
?>