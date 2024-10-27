<?php

function destroySession() {
    // Iniciar la sesión si no está iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Deshacerse de todas las variables de sesión
    $_SESSION = array();

    // Invalidar la cookie de sesión
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Destruir la sesión
    session_destroy();
}

// Ejemplo de uso
// Puedes llamar a esta función cuando quieras destruir los datos de sesión
// Por ejemplo, al cerrar sesión en tu aplicación
destroySession();
header('Location: '."/login");

?>