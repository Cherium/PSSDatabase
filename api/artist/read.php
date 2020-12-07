<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/artists.php';

$database = new Database();
$db = $database->getConnection();



$artist = new Artist($db);

$stmt = $artist->read();
$num = $stmt->rowCount();

if($num>0){
    $artists_arr=array();
    $artists_arr["records"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $artist_single=array(
            "E_name" => $E_name,
            "E_date" => $E_date,
            "Type" => $Type,
            "F_name" => $F_name,
            "L_name" => $L_name,
            "UCID" => $UCID
        );
  
        array_push($artists_arr["records"], $artist_single);
    }

	http_response_code(200);

	echo json_encode($artists_arr);
}
else {
	http_response_code(404);

    echo json_encode(
        array("message" => "No artists found.")
    );
}


?>