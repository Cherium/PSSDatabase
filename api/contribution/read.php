<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/contributions.php';

$database = new Database();
$db = $database->getConnection();



$contribution = new Contribution($db);

$stmt = $contribution->read();
$num = $stmt->rowCount();

if($num>0){
    $contributions_arr=array();
    $contributions_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $contribution_single=array(
            "Name" => $Name,
            "Transaction_no" => $Transaction_no,
        );
  
        array_push($contributions_arr["records"], $contribution_single);
    }

	http_response_code(200);

	echo json_encode($contributions_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No contributions found.")
    );
}


?>