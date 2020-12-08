<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/covers.php';

$database = new Database();
$db = $database->getConnection();



$cover = new Cover($db);

$stmt = $cover->read();
$num = $stmt->rowCount();

if($num>0){
    $covers_arr=array();
    $covers_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $cover_single=array(
            "Name" => $Name,
            "E_date" => $E_date,
            "Date" => $Date
        );
  
        array_push($covers_arr["records"], $cover_single);
    }

	http_response_code(200);

	echo json_encode($covers_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No covers found.")
    );
}


?>