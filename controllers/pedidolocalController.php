<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        $session = (isset($_POST['session']) ? $_POST['session'] : null);
        session_start();
        $_SESSION['nameClienteUnique'] = $session;
        echo "Ok";
        break;

    default:
        # code...
        break;
}
