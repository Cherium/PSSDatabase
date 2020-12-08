<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/authors.php';

$database = new Database();
$db = $database->getConnection();



$author = new Author($db);

$stmt = $author->read();
$num = $stmt->rowCount();

if($num>0){
    $authors_arr=array();
    $authors_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $author_single=array(
            "UCID" => $UCID,
            "Date" => $Date
        );
  
        array_push($authors_arr["records"], $author_single);
    }

	http_response_code(200);

	echo json_encode($authors_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No authors found.")
    );
}


?>