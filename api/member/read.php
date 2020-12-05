<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/members.php';

$database = new Database();
$db = $database->getConnection();

$member = new Member($db);

$stmt = $member->read();
$num = $stmt->rowCount();

if($num>0){
    $members_arr=array();
    $members_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $member_single=array(
            "UCID" => $UCID,
            "Internation_status" => $Internation_status,
            "Fname" => $Fname,
            "Lname" => $Lname,
            "Email" => $Email,
            "Year_of_study" => $Year_of_study,
            "Program" => $Program,
            "Subscription_status" => $Subscription_status,
            "Transaction_no" => $Transaction_no
        );
  
        array_push($members_arr["records"], $member_single);
    }


	http_response_code(200);

	echo json_encode($members_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No members found.")
    );
}


?>