<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/joined_ins.php';

$database = new Database();
$db = $database->getConnection();



$joined_in = new Joined_in($db);

$stmt = $joined_in->read();
$num = $stmt->rowCount();

if($num>0){
    $joined_ins_arr=array();
    $joined_ins_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $joined_in_single=array(
            "E_name" => $E_name,
            "E_date" => $E_date,
            "UCID" => $UCID,
        );
  
        array_push($joined_ins_arr["records"], $joined_in_single);
    }

	http_response_code(200);

	echo json_encode($joined_ins_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No joined_ins found.")
    );
}


?>