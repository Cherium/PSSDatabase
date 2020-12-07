<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/budgets.php';

$database = new Database();
$db = $database->getConnection();



$budget = new Budget($db);

$stmt = $budget->read();
$num = $stmt->rowCount();

if($num>0){
    $budgets_arr=array();
    $budgets_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $budget_single=array(
            "Name" => $Name,
            "Date" => $Date,
            "Transaction_no" => $Transaction_no,
            "Food" => $Food,
            "Rent" => $Rent,
            "Decoration" => $Decoration,
            "Performer" => $Performer,
            "Other" => $Other
        );
  
        array_push($budgets_arr["records"], $budget_single);
    }

	http_response_code(200);

	echo json_encode($budgets_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No budgets found.")
    );
}


?>