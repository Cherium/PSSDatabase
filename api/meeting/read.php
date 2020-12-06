<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/meetings.php';

$database = new Database();
$db = $database->getConnection();



$meeting = new Meeting($db);

$stmt = $meeting->read();
$num = $stmt->rowCount();

if($num>0){
    $meetings_arr=array();
    $meetings_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $meeting_single=array(
            "Date" => $Date,
            "Summary" => $Summary,
            "Department" => $Department
        );
  
        array_push($meetings_arr["records"], $meeting_single);
    }

	http_response_code(200);

	echo json_encode($meetings_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No meetings found.")
    );
}


?>