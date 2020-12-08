<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/sponsorships.php';

$database = new Database();
$db = $database->getConnection();



$sponsorship = new Sponsorship($db);

$stmt = $sponsorship->read();
$num = $stmt->rowCount();

if($num>0){
    $sponsorships_arr=array();
    $sponsorships_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $sponsorship_single=array(
            "Transaction_no" => $Transaction_no,
            "Package_type" => $Package_type,
            "Sponsor_name" => $Sponsor_name,
            "Sponsor_package" => $Sponsor_package
        );
  
        array_push($sponsorships_arr["records"], $sponsorship_single);
    }

	http_response_code(200);

	echo json_encode($sponsorships_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No sponsorships found.")
    );
}


?>