<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
switch ($requestMethod) {
    case 'POST':
        $id = (isset($_POST['id']) ? $_POST['id'] : null);
        $model->productDetails($id);
        
        break;
    
    default:
        # code...
        break;
}