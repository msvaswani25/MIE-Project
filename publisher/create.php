<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate publisher object
include_once '../objects/publisher.php';
 
$database = new Database();
$db = $database->getConnection();
 
$publisher = new publisher($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set publisher property values
$publisher->id = $data->name;
$publisher->price = $data->price;
$publisher->title = $data->title;
 
// create the publisher
if($publisher->create()){
    echo '{';
        echo '"message": "publisher was created."';
    echo '}';
}
 
// if unable to create the publisher, tell the user
else{
    echo '{';
        echo '"message": "Unable to create publisher."';
    echo '}';
}
?>