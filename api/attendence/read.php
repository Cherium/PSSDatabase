<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/attendences.php';

$database = new Database();
$db = $database->getConnection();

$attendence = new Attendence($db);

$stmt = $attendence->read();
$num = $stmt->rowCount();

if($num>0){
    $attendence_arr=array();
    $attendence_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $attendence_single=array(
            "Date" => $Date,
            "UCID" => $UCID
        );
  
        array_push($attendence_arr["records"], $attendence_single);
    }

	http_response_code(200);

	echo json_encode($attendence_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No attendence found.")
    );
}


?>