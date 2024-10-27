<?php
require_once('app.php');
class validateLog extends app
{
    public function login($data = [])
    {
        session_start();
        $sessionID = session_id();
        extract($data);
        $searchString = " ";
        $replaceString = "";
        $username = str_replace($searchString, $replaceString, $username);
        $query = "SELECT A.id,A.name,A.keyvalue,A.type,B.phone,B.id AS idStore FROM `log` A INNER JOIN liks B ON B.createdby = A.name WHERE A.name = '$username' OR B.phone='$username'";
        $newCon = $this->newCon;
        $sql = mysqli_query($newCon, $query);


        if ($f = mysqli_fetch_assoc($sql)) {
            if (password_verify($pass, $f['keyvalue'])) {
                $_SESSION['id'] = $f['id'];
                $_SESSION['nombre'] = $f['name'];
                $_SESSION['types'] = $f['type'];
                $_SESSION['phone'] = $f['phone'];
                $_SESSION['pass'] = $pass;
                $_SESSION['idStore'] = $f['idStore'];
                $user = array('id' => '3', 'token' => $token, 'id' => $f['id'], 'name' => $f['name'], 'type' => $f['type']);
                $userData = array('ok' => 'true', 'data' => $user);

                echo json_encode($userData);
            } else {
                $userData = array('ok' => 'false', 'id' => 'Contraseña incorrecta');
                echo json_encode($userData);
            }
        } else {
            $userData = array('ok' => 'false', 'id' => 'Usuario no existe');
            echo json_encode($userData);
        }
    }
    public function validateSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id  = (isset($_SESSION['id']) ? $_SESSION['id'] : null);
        $query = "SELECT * FROM log WHERE id = '$id'";
        $newCon = $this->newCon;
        $sql = mysqli_query($newCon, $query);
        $row = mysqli_fetch_array($sql);
        $id  = (isset($row[0]) ? $row[0] : null);
        if ($id != null) {
            if (password_verify($_SESSION['pass'], $row['keyvalue'])) {
                return 1;
            } else {
                return 2;
            }
        } else {
            return 3;
        }
    }
    public function validateModulePaid($module, $user)
    {
        $newCon = $this->newCon;
        $query = "SELECT * FROM `paidModules` A WHERE A.module = '$module' AND A.user = '$user'";
        $sql = mysqli_query($newCon, $query);
        $row = mysqli_fetch_array($sql);
        if ($row) {
            return $row[3];
        } else {
            return 0;
        }
    }
}
