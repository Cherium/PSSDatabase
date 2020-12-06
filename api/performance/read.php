<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/performances.php';

$database = new Database();
$db = $database->getConnection();



$performance = new Performance($db);

$stmt = $performance->read();
$num = $stmt->rowCount();

if($num>0){
    $performances_arr=array();
    $performances_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $performance_single=array(
            "E_name" => $E_name,
            "E_date" => $E_date,
            "Type" => $Type
        );
  
        array_push($performances_arr["records"], $performance_single);
    }

	http_response_code(200);

	echo json_encode($performances_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No performances found.")
    );
}


?>