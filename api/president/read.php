<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/presidents.php';

$database = new Database();
$db = $database->getConnection();



$president = new President($db);

$stmt = $president->read();
$num = $stmt->rowCount();

if($num>0){
    $presidents_arr=array();
    $presidents_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $president_single=array(
            "UCID" => $UCID,
            "Date_elected" => $Date_elected
        );
  
        array_push($presidents_arr["records"], $president_single);
    }

	http_response_code(200);

	echo json_encode($presidents_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No presidents found.")
    );
}


?>