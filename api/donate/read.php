<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/donates.php';

$database = new Database();
$db = $database->getConnection();



$donate = new Donate($db);

$stmt = $donate->read();
$num = $stmt->rowCount();

if($num>0){
    $donates_arr=array();
    $donates_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $donate_single=array(
            "UCID" => $UCID,
            "Transaction_no" => $Transaction_no,
        );
  
        array_push($donates_arr["records"], $donate_single);
    }

	http_response_code(200);

	echo json_encode($donates_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No donates found.")
    );
}


?>