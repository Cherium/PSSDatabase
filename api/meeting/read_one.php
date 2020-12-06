<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
  
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/meetings.php';
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare product object
    $meeting = new Meeting($db);
  
    // set ID property of record to read
    $meeting->Date = isset($_GET['Date']) ? $_GET['Date'] : die();



    // read the details of product to be edited
    $meeting->readOne();
  

    if(($meeting->Date!=null)){
        // create array
        $meetings_arr = array(
            "Date" => $meeting->Date,
            "Summary" => $meeting->Summary,
            "Department" => $meeting->Department
  
        );
  
        // set response code - 200 OK
        http_response_code(200);
  
        // make it json format
        echo json_encode($meetings_arr);
    }
  
    else{
        // set response code - 404 Not found
        http_response_code(404);
  
        // tell the user product does not exist
        echo json_encode(array("message" => "Meeting does not exist."));
    }
?>