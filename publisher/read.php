<?php



// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/publisher.php';
 
// instantiate database and publisher object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$publisher = new Publisher($db);
 
// query publishers
$stmt = $publisher->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // publishers array
    $publishers_arr=array();
    $publishers_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $publisher_item=array(
            "title" => $title,            
            "id" => $id,
            "price" => $price
        );
 
        array_push($publishers_arr["records"], $publisher_item);
    }
 
    echo json_encode($publishers_arr);
}
 
else{
    echo json_encode(
        array("message" => "No publishers found.")
    );
}
?>