<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/e_hosts.php';

$database = new Database();
$db = $database->getConnection();



$e_host = new E_host($db);

$stmt = $e_host->read();
$num = $stmt->rowCount();

if($num>0){
    $e_hosts_arr=array();
    $e_hosts_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $e_host_single=array(
            "Name" => $Name,
            "Date" => $Date,
            "UCID" => $UCID,
        );
  
        array_push($e_hosts_arr["records"], $e_host_single);
    }

	http_response_code(200);

	echo json_encode($e_hosts_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No e_hosts found.")
    );
}


?>