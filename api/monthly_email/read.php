<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/monthly_emails.php';

$database = new Database();
$db = $database->getConnection();



$monthly_email = new Monthly_email($db);

$stmt = $monthly_email->read();
$num = $stmt->rowCount();

if($num>0){
    $monthly_emails_arr=array();
    $monthly_emails_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $monthly_email_single=array(
            "Date" => $Date
        );
  
        array_push($monthly_emails_arr["records"], $monthly_email_single);
    }

	http_response_code(200);

	echo json_encode($monthly_emails_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No monthly_emails found.")
    );
}


?>