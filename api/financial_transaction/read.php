<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/events.php';

$database = new Database();
$db = $database->getConnection();



$financial_transation = new financial_transaction($db);

$stmt = $financial_transation->read();
$num = $stmt->rowCount();

if($num>0){
    $events_arr=array();
    $events_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $event_single=array(
            "Transaction_no" => $No,
            "Date" => $Date,
            "Amount" => $Amount,
            
        );
  
        array_push($events_arr["records"], $event_single);
    }

	http_response_code(200);

	echo json_encode($events_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No events found.")
    );
}


?>