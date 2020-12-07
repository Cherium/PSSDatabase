<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/foods.php';

$database = new Database();
$db = $database->getConnection();



$food = new Food($db);

$stmt = $food->read();
$num = $stmt->rowCount();

if($num>0){
    $foods_arr=array();
    $foods_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $food_single=array(
            "E_name" => $E_name,
            "E_date" => $E_date,
            "Food" => $Food
        );
  
        array_push($foods_arr["records"], $food_single);
    }

	http_response_code(200);

	echo json_encode($foods_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No foods found.")
    );
}


?>