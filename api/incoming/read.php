<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/incomings.php';

$database = new Database();
$db = $database->getConnection();



$incoming = new Incoming($db);

$stmt = $incoming->read();
$num = $stmt->rowCount();

if($num>0){
    $incomings_arr=array();
    $incomings_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $incoming_single=array(
            "Transaction_no" => $Transaction_no,
            "Package_type" => $Package_type
        );
  
        array_push($incomings_arr["records"], $incoming_single);
    }

	http_response_code(200);

	echo json_encode($incomings_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No incoming transactions found.")
    );
}


?>