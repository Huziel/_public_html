<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'GET':

        break;
    case 'POST':
        $session = (isset($_POST['idPD']) ? $_POST['idPD'] : null);
        $name = (isset($_POST['namePD']) ? $_POST['namePD'] : null);

        $variable = (isset($_POST['variablePD']) ? $_POST['variablePD'] : null);
        $descr = (isset($_POST['descrPD']) ? $_POST['descrPD'] : null);
        $price = (isset($_POST['precioPD']) ? $_POST['precioPD'] : null);
        $activeProduct = (isset($_POST['activeProduct']) ? $_POST['activeProduct'] : null);
        $stockInp = (isset($_POST['stockInp']) ? $_POST['stockInp'] : null);
        $fotoAux = (isset($_POST['fotoAuxED']) ? $_POST['fotoAuxED'] : null);
        $barcode = (isset($_POST['barcodeInput']) ? $_POST['barcodeInput'] : null);
        if ($session != null) {
            if (($_FILES["imagePDSI"]["type"] == "image/pjpeg")
                || ($_FILES["imagePDSI"]["type"] == "image/jpeg")
                || ($_FILES["imagePDSI"]["type"] == "image/jpg")
                || ($_FILES["imagePDSI"]["type"] == "image/png")
                || ($_FILES["imagePDSI"]["type"] == "image/gif"
                    || $fotoAux)
            ) {
                $rand = rand(1, 99);
                $fechaActual = date('d-m-Y');
                $nameArch = $rand . $fechaActual . $session . $name . $_FILES['imagePDSI']['name'];
                if (move_uploaded_file($_FILES["imagePDSI"]["tmp_name"], "../app/themp/objets/images/" . $nameArch)) {
                    $link = "https://" . $host . "/app/themp/objets/images/" . $nameArch;
                    $link  = str_replace(' ', '%20', $link);
                    $idpicture = $model->editPOne($data = [
                        "session" => "$session",
                        "name" => "$name",
                        "variable" => "$variable",
                        "descr" => "$descr",
                        "price" => "$price",
                        "link" => "$link",
                        "activeProduct" => "$activeProduct"
                    ]);
                    $idStock = $model->addStock($data = [
                        "idProd" => "$session",
                        "value" => "$stockInp",
                    ]);
                    
                    $jsonArray = array();
                    foreach ($_FILES["imagePDS"]['tmp_name'] as $key => $tmp_name) {
                        if (($_FILES["imagePDS"]["type"][$key] == "image/pjpeg")
                            || ($_FILES["imagePDS"]["type"][$key] == "image/jpeg")
                            || ($_FILES["imagePDS"]["type"][$key] == "image/jpg")
                            || ($_FILES["imagePDS"]["type"][$key] == "image/png")
                            || ($_FILES["imagePDS"]["type"][$key] == "image/gif")
                        ) {
                            $filename = $_FILES["imagePDS"]["name"][$key];
                            $source = $_FILES["imagePDS"]["tmp_name"][$key];
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
                    $userData = array('ok' => 'true', 'array' => $jsonArray, 'id' => $session);
                    echo json_encode($userData);
                } else {

                    $idpicture = $model->editPOne($data = [
                        "session" => "$session",
                        "name" => "$name",
                        "variable" => "$variable",
                        "descr" => "$descr",
                        "price" => "$price",
                        "link" => "$fotoAux",
                        "activeProduct" => "$activeProduct"
                    ]);
                    $idStock = $model->addStock($data = [
                        "idProd" => "$session",
                        "value" => "$stockInp",
                    ]);
                    
                    $userData = array('ok' => 'aux', 'data' => "Producto registrado", 'id' => $session);
                    echo json_encode($userData);
                }
            } else {
                $idpicture = $model->editPOne($data = [
                    "session" => "$session",
                    "name" => "$name",
                    "variable" => "$variable",
                    "descr" => "$descr",
                    "price" => "$price",
                    "activeProduct" => "$activeProduct"
                ]);
                $idStock = $model->addStock($data = [
                    "idProd" => "$session",
                    "value" => "$stockInp",
                ]);
                $idbarcode = $model->insertBarcode($data = [
                    "idP" => "$session",
                    "barcode" => "$barcode",
                ]);
                foreach ($_FILES["imagePDS"]['tmp_name'] as $key => $tmp_name) {
                    if (($_FILES["imagePDS"]["type"][$key] == "image/pjpeg")
                        || ($_FILES["imagePDS"]["type"][$key] == "image/jpeg")
                        || ($_FILES["imagePDS"]["type"][$key] == "image/jpg")
                        || ($_FILES["imagePDS"]["type"][$key] == "image/png")
                        || ($_FILES["imagePDS"]["type"][$key] == "image/gif")
                    ) {
                        $filename = $_FILES["imagePDS"]["name"][$key];
                        $source = $_FILES["imagePDS"]["tmp_name"][$key];
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
                $userData = array('ok' => 'true', 'data' => "Datos actualizados", 'id' => $session);
                echo json_encode($userData);
            }
        } else {

            $userData = array('ok' => 'false', 'data' => "Error de producto");
            echo json_encode($userData);
        }

        break;
    default:
        # code...
        break;
}
