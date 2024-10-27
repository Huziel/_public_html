<?php
require_once('../class/validateLog.php');

$model = new validateLog;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
switch ($requestMethod) {
    case 'GET':
        post($model);
        break;
    case 'POST':
        post($model);
        break;
}
function post($model)
{
    $mail = (isset($_POST['mail']) ? $_POST['mail'] : null);
    $pass = (isset($_POST['pass']) ? $_POST['pass'] : null);
    if (empty($mail) || empty($pass)) {
        $userData = array('ok' => 'false', 'id' => 'Datos vacios');
        echo json_encode($userData);
    } else {
        $model->login($data = [
            "username" => "$mail",
            "pass" => "$pass"
        ]);
    }
}
