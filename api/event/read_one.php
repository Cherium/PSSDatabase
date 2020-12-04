<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
  
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/events.php';
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare product object
    $event = new Event($db);
  
    // set ID property of record to read
    $event->Name = isset($_GET['Name']) ? $_GET['Name'] : die();
    $event->Date = isset($_GET['Date']) ? $_GET['Date'] : die();



    // read the details of product to be edited
    $event->readOne();
  

    if(($event->Name!=null) && ($event->Date!=null)){
        // create array
        $events_arr = array(
            "Name" => $event->Name,
            "Date" => $event->Date,
            "Location" => $event->Location,
            "FundraiserName" => $event->FundraiserName
  
        );
  
        // set response code - 200 OK
        http_response_code(200);
  
        // make it json format
        echo json_encode($events_arr);
    }
  
    else{
        // set response code - 404 Not found
        http_response_code(404);
  
        // tell the user product does not exist
        echo json_encode(array("message" => "Event does not exist."));
    }
?>