<?php

class app{
    public function __construct()
{
   
    
    $uri = $_SERVER['REQUEST_URI']; /* Obtenemos la URL */
    $uriParts = explode('/', $uri); /* la dividimos  */
    $this->rpart = $uriParts[3]; /* Recpcionamos la division 2 */
}
public function route(){
    $part = $this->rpart;
    switch ($part) {
        case '':
            session_destroy();
            require_once('protector.php');
            break;
            case 'login':
            session_destroy();
            require_once('login.php');
            break;
            case 'home':
                require_once('home.php');
                break;
                 case 'protector':
                require_once('protector.php');
                break;
                case 'page':
                require_once('page.php');
                break;
                case 'adults':
                    require_once('adults.php');
                    break;
    }
}
}
