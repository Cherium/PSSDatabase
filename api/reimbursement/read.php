<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/reimbursements.php';

$database = new Database();
$db = $database->getConnection();



$reimbursement = new Reimbursement($db);

$stmt = $reimbursement->read();
$num = $stmt->rowCount();

if($num>0){
    $reimbursements_arr=array();
    $reimbursements_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $reimbursement_single=array(
            "UCID" => $UCID,
            "Transaction_no" => $Transaction_no
        );
  
        array_push($reimbursements_arr["records"], $reimbursement_single);
    }

	http_response_code(200);

	echo json_encode($reimbursements_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No reimbursements found.")
    );
}


?>