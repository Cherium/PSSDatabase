<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/topics.php';

$database = new Database();
$db = $database->getConnection();



$topic = new Topic($db);

$stmt = $topic->read();
$num = $stmt->rowCount();

if($num>0){
    $topics_arr=array();
    $topics_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $topic_single=array(
            "Date" => $Date,
            "Name" => $Name
        );
  
        array_push($topics_arr["records"], $topic_single);
    }

	http_response_code(200);

	echo json_encode($topics_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No topics found.")
    );
}


?>