<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        switch ($_POST['type']) {
            case 'phone':
                $id = (isset($_POST['id']) ? $_POST['id'] : null);
                $value = (isset($_POST['value']) ? $_POST['value'] : null);
                $model->editCatInfo($data = [
                    "type" => "phone",
                    "value" => "$value",
                    "id" => "$id"
                ]);
                break;
            case 'paypal':
                $id = (isset($_POST['id']) ? $_POST['id'] : null);
                $value = (isset($_POST['value']) ? $_POST['value'] : null);
                $model->editCatInfo($data = [
                    "type" => "paypal",
                    "value" => "$value",
                    "id" => "$id"
                ]);
                break;
            case 'color':
                $id = (isset($_POST['id']) ? $_POST['id'] : null);
                $value = (isset($_POST['value']) ? $_POST['value'] : null);
                $model->editCatInfo($data = [
                    "type" => "color",
                    "value" => "$value",
                    "id" => "$id"
                ]);
                break;
            case 'location':
                $id = (isset($_POST['id']) ? $_POST['id'] : null);
                $adress = (isset($_POST['adress']) ? $_POST['adress'] : null);
                $lat = (isset($_POST['lat']) ? $_POST['lat'] : null);
                $lng = (isset($_POST['lng']) ? $_POST['lng'] : null);
                $model->editCatInfoAdress($data = [
                    "id" => "$id",
                    "adress" => "$adress",
                    "lat" => "$lat",
                    "lng" => "$lng"
                ]);
                break;
            case 'logo':
                $id = (isset($_POST['id']) ? $_POST['id'] : null);
                $value = (isset($_POST['value']) ? $_POST['value'] : null);
                $model->editCatInfo($data = [
                    "type" => "logo",
                    "value" => "$value",
                    "id" => "$id"
                ]);
                break;

            default:
                # code...
                break;
        }


        break;

    default:
        # code...
        break;
}
