<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/departments.php';

$database = new Database();
$db = $database->getConnection();



$department = new Department($db);

$stmt = $department->read();
$num = $stmt->rowCount();

if($num>0){
    $departments_arr=array();
    $departments_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $department_single=array(
            "Name" => $Name,
            "H_UCID" => $H_UCID
        );
  
        array_push($departments_arr["records"], $department_single);
    }

	http_response_code(200);

	echo json_encode($departments_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No departments found.")
    );
}


?>