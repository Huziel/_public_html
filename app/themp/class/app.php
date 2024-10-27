<?php
class app
{
    public function conectar()
    {
        $host = "localhost";
        $user = "u119629285_huziel";
        $pass = 'Huzidrago666';
        $db = "u119629285_catalogos";
        $con = new MySQLi("$host", "$user", "$pass", "$db");
        return $con;
    }
    public function login($data = [])
    {
        session_start();
        $sessionID = session_id();
        $token = base64_encode($sessionID);
        $conn = new app;
        $newCon = $conn->conectar();
        extract($data);
        $searchString = " ";
        $replaceString = "";
        $username = str_replace($searchString, $replaceString, $username);
        $query = "SELECT * FROM log WHERE name = '$username'";
        $sql = mysqli_query($newCon, $query);
        if ($f = mysqli_fetch_assoc($sql)) {
            if (password_verify($pass, $f['keyvalue'])) {
                $_SESSION['id'] = $f['id'];
                $_SESSION['nombre'] = $f['name'];
                $_SESSION['types'] = $f['type'];
                $user = array('id' => '3', 'token' => $token, 'id' => $f['id'], 'name' => $f['name'], 'type' => $f['type']);
                $userData = array('ok' => 'true', 'data' => $user);

                echo json_encode($userData);
            } else {
                $userData = array('ok' => 'false', 'id' => 'Contraseña incorrecta');
                echo json_encode($userData);
            }
        } else {
            /* $hash = password_hash($pass, PASSWORD_DEFAULT);
            $queryInsert = "INSERT INTO `log` (`id`, `name`, `keyvalue`) VALUES (NULL, '$username', '$hash')";
            $sqlInsert = mysqli_query($newCon, $queryInsert);
            $_SESSION['nombre'] = $username; */
            $userData = array('ok' => 'false', 'id' => 'Usuario no existe');
            echo json_encode($userData);
        }
    }
    public function register($data = [])
    {
        
        session_start();
        date_default_timezone_set('America/Mexico_City');
        $conn = new app;
        $newCon = $conn->conectar();
        extract($data);
        
        $username = str_replace(" ", "", $username);
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $fecha = strftime("%Y-%m-%d %T");
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $uri);
        $fechaFormated = new DateTime($fecha);
        $query = "SELECT * FROM log WHERE name = '$username'";
        $queryInsert = "INSERT INTO `log` (`id`, `name`, `keyvalue`) VALUES (NULL, '$username', '$hash')";
        $sql = mysqli_query($newCon, $query);
        if ($f = mysqli_fetch_assoc($sql)) {
            $userData = array('ok' => 'false', 'id' => 'Ya existe usuario registrado con el mismo alias');
            echo json_encode($userData);
        } else {
            $queryInsert = "INSERT INTO `log` (`id`, `name`, `keyvalue`) VALUES (NULL, '$username', '$hash')";
            $sqlInsert = mysqli_query($newCon, $queryInsert);
            $fechaFormated->modify('+1 month');
            $FInicioFormat = $fechaFormated->format('d-m-Y H:i:s');
            $rand = rand(1, 999);
            $sessionID = session_id();
            $geberate = $sessionID . $rand;
            $name = $geberate;
            $sqlC = mysqli_query($newCon, "INSERT INTO `liks` (`id`, `serial`, `time`, `phone`, `session`, `createdby`, `type`, `category`, `adress`, `color`, `logo`, `locales`, `logojpg`, `paypal`, `lat`, `long`) VALUES (NULL, '$name', '$FInicioFormat', '$phone', NULL, '$username', '1', '$cat', '$adress', '$color', null, null, null, null, '$latitude', '$longitude')");
            $link = $_SERVER['SERVER_NAME']. "/themp/page.php?id=". $name."%26".$username;
            $userData = array('ok' => 'true', 'id' => 'Usuario creado','link' => $link);
            echo json_encode($userData);
        }
    }
}
