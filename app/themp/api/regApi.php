<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once('../class/app.php');
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$a = new app();
switch ($requestMethod) {
    case 'GET':
        $userData['data'][] = array('id' => 'hola mundo');
        echo json_encode($userData);
        break;

    case 'POST':
        postReg($a);

        break;
}
function postReg($a)
{
    $data = json_decode(file_get_contents("php://input"));

    $a->register($data = [
        "username" => "$data->correo",
        "pass" => "$data->pass",
        "phone" => "$data->phone",
        "cat" => "$data->cat",
        "adress" => "$data->adress",
        "color" => "$data->color",
        "latitude" => "$data->latitude",
        "longitude" => "$data->longitude"
    ]);
    
}
