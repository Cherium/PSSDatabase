<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/outgoings.php';

$database = new Database();
$db = $database->getConnection();



$outgoing = new Outgoing($db);

$stmt = $outgoing->read();
$num = $stmt->rowCount();

if($num>0){
    $outgoings_arr=array();
    $outgoings_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $outgoing_single=array(
            "Transaction_no" => $Transaction_no,
            "Type_of_transfer" => $Type_of_transfer
        );
  
        array_push($outgoings_arr["records"], $outgoing_single);
    }

	http_response_code(200);

	echo json_encode($outgoings_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No outgoings found.")
    );
}


?>