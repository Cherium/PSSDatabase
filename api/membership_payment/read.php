<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/membership_payments.php';

$database = new Database();
$db = $database->getConnection();



$membership_payment = new Membership_payment($db);

$stmt = $membership_payment->read();
$num = $stmt->rowCount();

if($num>0){
    $membership_payments_arr=array();
    $membership_payments_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $membership_payment_single=array(
            "Transaction_no" => $Transaction_no,
            "Payment_status" => $Payment_status
        );
  
        array_push($membership_payments_arr["records"], $membership_payment_single);
    }

	http_response_code(200);

	echo json_encode($membership_payments_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No membership_payments found.")
    );
}


?>