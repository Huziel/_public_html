<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'GET':
        $var = (isset($_GET['created']) ? $_GET['created'] : null);

        $model->listarP($var);
        break;
    case 'POST':
        $session = (isset($_POST['session']) ? $_POST['session'] : null);
        $name = (isset($_POST['name']) ? $_POST['name'] : null);
        $variable = (isset($_POST['variable']) ? $_POST['variable'] : null);
        $descr = (isset($_POST['descr']) ? $_POST['descr'] : null);
        $price = (isset($_POST['price']) ? $_POST['price'] : null);
        $category = (isset($_POST['category']) ? $_POST['category'] : null);
        $fotoAux = (isset($_POST['fotoAux']) ? $_POST['fotoAux'] : null);
        if ($session != null) {
            if (($_FILES["imageP"]["type"] == "image/pjpeg")
                || ($_FILES["imageP"]["type"] == "image/jpeg")
                || ($_FILES["imageP"]["type"] == "image/jpg")
                || ($_FILES["imageP"]["type"] == "image/png")
                || ($_FILES["imageP"]["type"] == "image/gif")
                || $fotoAux
            ) {
                $rand = rand(1, 99);
                $fechaActual = date('d-m-Y');
                $nameArch = $rand . $fechaActual . $session . $_FILES['imageP']['name'];
                if (move_uploaded_file($_FILES["imageP"]["tmp_name"], "../app/themp/objets/images/" . $nameArch)) {
                    $link = "https://" . $host . "/app/themp/objets/images/" . $nameArch;
                    $link  = str_replace(' ', '%20', $link);
                    $idpicture = $model->addPOne($data = [
                        "session" => "$session",
                        "name" => "$name",
                        "variable" => "$variable",
                        "descr" => "$descr",
                        "price" => "$price",
                        "link" => "$link",
                        "category" => "$category"
                    ]);
                    $jsonArray = array();
                    foreach ($_FILES["imagePD"]['tmp_name'] as $key => $tmp_name) {
                        if (($_FILES["imagePD"]["type"][$key] == "image/pjpeg")
                            || ($_FILES["imagePD"]["type"][$key] == "image/jpeg")
                            || ($_FILES["imagePD"]["type"][$key] == "image/jpg")
                            || ($_FILES["imagePD"]["type"][$key] == "image/png")
                            || ($_FILES["imagePD"]["type"][$key] == "image/gif")
                        ) {
                            $filename = $_FILES["imagePD"]["name"][$key];
                            $source = $_FILES["imagePD"]["tmp_name"][$key];
                            $directorio = '../app/themp/objets/docs/';
                            if (!file_exists($directorio)) {
                                mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");
                            }
                            $dir = opendir($directorio);
                            $target_path = $directorio . '/' . $rand . $fechaActual . $session . $filename;
                            if (move_uploaded_file($source, $target_path)) {
                                $link = "https://" . $host . "/app/themp/objets/docs/" . $rand . $fechaActual . $session . $filename;
                                $link  = str_replace(' ', '%20', $link);
                                $model->addMultiPicture($data = [
                                    "link" => "$link",
                                    "session" => "$session",
                                    "idp" => "$idpicture"
                                ]);
                                $jsonArray['data'][] = $filename . " Subido correctamente";
                            } else {

                                $jsonArray['data'][] = "Error al subir: " . $filename;
                            }
                        } else {

                            $jsonArray['data'][] = "Archivo invalido: " . $filename;
                        }
                    }
                    $userData = array('ok' => 'true', 'array' => $jsonArray);
                    echo json_encode($userData);
                } else {
                    $idpicture = $model->addPOne($data = [
                        "session" => "$session",
                        "name" => "$name",
                        "variable" => "$variable",
                        "descr" => "$descr",
                        "price" => "$price",
                        "link" => "$fotoAux",
                        "category" => "$category"
                    ]);
                    $userData = array('ok' => 'aux', 'data' => "Producto registrado");
                    echo json_encode($userData);
                }
            } else {

                $userData = array('ok' => 'false', 'data' => "Formato invalido o inexistente");
                echo json_encode($userData);
            }
        } else {

            $userData = array('ok' => 'false', 'data' => "Error de usuario");
            echo json_encode($userData);
        }

        break;
    default:
        # code...
        break;
}
