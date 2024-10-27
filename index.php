<?php
header('Connection: Keep-Alive');
function papasAlaFrancesa()
{
    $uri = explode('/', $_SERVER['REQUEST_URI']);
    $path = $uri[1];

    $rest = $path[0];
    if ($rest == '@') {
        require_once('./class/app.php');
        $rest = substr($path, 1);
        $model = new app;
        $model->redirectPage($rest);
    } else {
        require_once('./class/routes.php');

        $view = new routes($path);
    }
}
papasAlaFrancesa();
?>
<script>
    function handleAndroidParam(param) {
        console.log("Received from Android: " + param);

        // Guardar el parámetro en localStorage
        localStorage.setItem("androidParam", param);

        // Para confirmar que el parámetro se guardó correctamente
        let cachedParam = localStorage.getItem("androidParam");
        console.log("Cached param: " + cachedParam);
    }
</script>