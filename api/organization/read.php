<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/organizations.php';

$database = new Database();
$db = $database->getConnection();



$organization = new Organization($db);

$stmt = $organization->read();
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
            "Name" => $Name,
            "Contact" => $Contact
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