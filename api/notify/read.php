<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/notifys.php';

$database = new Database();
$db = $database->getConnection();



$notify = new Notify($db);

$stmt = $notify->read();
$num = $stmt->rowCount();

if($num>0){
    $notifys_arr=array();
    $notifys_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $notify_single=array(
            "UCID" => $UCID,
            "Date" => $Date
        );
  
        array_push($notifys_arr["records"], $notify_single);
    }

	http_response_code(200);

	echo json_encode($notifys_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No notifys found.")
    );
}


?>