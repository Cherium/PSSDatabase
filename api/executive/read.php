<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/executives.php';

$database = new Database();
$db = $database->getConnection();



$executive = new Executive($db);

$stmt = $executive->read();
$num = $stmt->rowCount();

if($num>0){
    $executives_arr=array();
    $executives_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $executive_single=array(
            "EUCID" => $EUCID,
            "Date_elected" => $Date_elected,
            "Dname" => $Dname
        );
  
        array_push($executives_arr["records"], $executive_single);
    }

	http_response_code(200);

	echo json_encode($executives_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No executives found.")
    );
}


?>