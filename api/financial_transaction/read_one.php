<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
  
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/financial_transaction.php';
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare product object
    $financial_transaction = new financial_transaction($db);
  
    // set ID property of record to read
    $financial_transaction->Transaction_no = isset($_GET['TransactionNo']) ? $_GET['TransactionNo'] : die();
    $financial_transaction->Date = isset($_GET['Date']) ? $_GET['Date'] : die();



    // read the details of product to be edited
    $financial_transaction->readOne();
  

    if(($financial_transaction->Transaction_no!=null) && ($financial_transaction->Date!=null)){
        // create array
        $events_arr = array(
            "Transaction_no" => $financial_transaction->Transaction_no,
            "Date" => $financial_transaction->Date
            
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