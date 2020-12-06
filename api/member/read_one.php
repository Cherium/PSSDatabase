<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
  
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/members.php';
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare product object
    $member = new Member($db);
  
    // set ID property of record to read
    $member->UCID = isset($_GET['UCID']) ? $_GET['UCID'] : die();




    // read the details of product to be edited
    $member->readOne();
  


    if(($member->UCID!=null)){
        // create array
        $members_arr = array(
            "UCID" => $member->UCID,
            "Int_stat" => $member->Int_stat,
            "Fname" => $member->Fname,
            "Lname" => $member->Lname,
            "Email" => $member->Email,
            "Year_of_study" => $member->Year_of_study,
            "Program" => $member->Program,
            "Subscription_status" => $member->Subscription_status,
            "Transaction_no" => $member->Transaction_no
            //"E_name" => $member->E_name,
            //"E_date" => $member->E_date
  
        );
  
        // set response code - 200 OK
        http_response_code(200);
  
        // make it json format
        echo json_encode($members_arr);
    }
  
    else{
        // set response code - 404 Not found
        http_response_code(404);
  
        // tell the user product does not exist
        echo json_encode(array("message" => "Member does not exist."));
    }
?>