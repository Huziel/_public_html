<?php
class routes
{

    public function __construct($path)
    {
        require_once('templates.php');
        require_once('validateLog.php');
        $vali = new validateLog;
        $validar = $vali->validateSession();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $user =  (isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null);
        $id =  (isset($_SESSION['id']) ? $_SESSION['id'] : null);
        $types =  (isset($_SESSION['types']) ? $_SESSION['types'] : null);

        if ($validar == 1) {
            if ($_SESSION['paginitaURL']) {
                header('Location: ' . "/@" . $_SESSION['paginitaURL']);
            } else {
                switch ($types) {
                    case '1':
                        $paidModule = $vali->validateModulePaid($path, $id);
                        $this->user($path, $user, $id, $types, $paidModule);
                        break;
                    case '3':
                        $this->deliver($path, $user, $id, $types);
                        break;
                    case '4':
                        $this->client($path, $user, $id, $types);
                        break;
                    default:
                        $this->free($path, $user, $id, $types);
                        break;
                }
            }
        } else {
            switch ($path) {
                case 'register':
                    $template = new Template("./dashboard/views/register.html");
                    echo $template;
                    break;
                case 'login':
                    header('Location: ' . "/@310");
                    break;
                case 'login2':
                    $template = new Template("./dashboard/views/login.html");
                    echo $template;
                    break;

                case 'recover':
                    $template = new Template("./dashboard/views/recover.html");
                    echo $template;
                    break;
                case 'privacidad':
                    $template = new Template("./dashboard/views/privacidad.html");
                    echo $template;
                    break;


                default:
                    /*   $id = (isset($_GET['id']) ? $_GET['id'] : null);
                    if ($id == null) {
                        $id = "CANIVADIS";
                    }
                    $template = new Template("",$data = [
                        "idF" => $id
                    ]);
                    echo $template; */
                    header('Location: ' . "/@310");
                    break;
            }
        }
    }

    public function free($path, $user, $idUser, $types)
    {

        switch ($path) {

            case 'listP':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $sidebar = new Template("./dashboard/views/sidebar.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Listado de productos',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/free/listP.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,
                    "sidebar" => $sidebar,
                    "content" => $content
                ]);
                echo $template;
                break;
            case 'catalogo':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $sidebar = new Template("./dashboard/views/sidebar.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Detalles del catalogo',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/free/catalogo.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,
                    "sidebar" => $sidebar,
                    "content" => $content
                ]);
                echo $template;
                break;
            case 'general':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $sidebar = new Template("./dashboard/views/sidebar.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Registro de pedidos',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/free/general.html", $data = [
                    "nav" => $nav,
                    "user" => $user,
                    "idToken2" => $_SESSION['paginitaURL']

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,
                    "sidebar" => $sidebar,
                    "content" => $content
                ]);
                echo $template;
                break;
            case 'admin':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $sidebar = new Template("./dashboard/views/sidebar.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Registro de pedidos',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/free/admin.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,
                    "sidebar" => $sidebar,
                    "content" => $content
                ]);
                echo $template;
                break;

            default:
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $sidebar = new Template("./dashboard/views/sidebar.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Registro de pedidos',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/free/general.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,
                    "sidebar" => $sidebar,
                    "content" => $content
                ]);
                echo $template;
                break;
        }
    }
    public function user($path, $user, $idUser, $types, $paidModule)
    {
        switch ($path) {
            case 'tiendas':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $footer = new Template("./dashboard/views/footer/footerNormal.html", $data = ["name" => $path]);
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Tiendas',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/deliver/stores.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => "$content",
                    "footer" => $footer
                ]);
                echo $template;
                break;
            case 'pedidos':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $footer = new Template("./dashboard/views/footer/footerNormal.html", $data = ["name" => $path]);
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Pedidos Repartidor',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/deliver/pedidos.html", $data = [
                    "nav" => $nav,
                    "user" => $user,
                    "idToken" => $idUser

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => "$content",
                    "footer" => $footer
                ]);
                echo $template;
                break;
            case 'porfile':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $footer = new Template("./dashboard/views/footer/footerNormal.html", $data = ["name" => $path]);
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Perfil Repartidor',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/deliver/porfile.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => "$content",
                    "footer" => $footer
                ]);
                echo $template;
                break;
            case 'puntoVenta':

                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $footer = new Template("./dashboard/views/footer/footerNormal.html", $data = ["name" => $path]);
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Punto de venta',
                    "user" => $user

                ]);
                if ($paidModule == 1) {
                    $content = new Template("./dashboard/views/puntoVenta/vistaGeneral.html", $data = [
                        "nav" => $nav,
                        "user" => $user

                    ]);
                } else {
                    $content = "<center><h1 class = 'mt-5'>Modulo bloqueado</h1><br><h1><i class='fas fa-lock mt-3 mb-3'></i></h1><br><h2 class='mt-3'>Contrata plan para desbloquear</h2></center>";
                }
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => "$content",
                    "footer" => $footer
                ]);
                echo $template;


                break;
            case 'panelVentas':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $footer = new Template("./dashboard/views/footer/footerNormal.html", $data = ["name" => $path]);
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Punto de venta',
                    "user" => $user

                ]);
                if ($paidModule == 1) {
                    $content = new Template("./dashboard/views/puntoVenta/panelVentas.html", $data = [
                        "nav" => $nav,
                        "user" => $user

                    ]);
                } else {
                    $content = "Modulo bloqueado";
                }
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => "$content",
                    "footer" => ""
                ]);
                echo $template;
                break;

            case 'general':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $footer = new Template("./dashboard/views/footer/footerNormal.html", $data = ["name" => $path]);
                $sidebar = new Template("./dashboard/views/sidebarUserS.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Registro de pedidos',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/free/general.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => $content,
                    "footer" => $footer
                ]);
                echo $template;
                break;
            case 'catalogo':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $footer = new Template("./dashboard/views/footer/footerNormal.html", $data = ["name" => $path]);
                $sidebar = new Template("./dashboard/views/sidebarUserS.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Detalles del catalogo',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/free/catalogo.html", $data = [
                    "nav" => $nav,
                    "user" => $user,
                    "idToken" => $idUser,
                    "paidModule" => $paidModule

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => $content,
                    "footer" => $footer
                ]);
                echo $template;
                break;
            case 'listP':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $footer = new Template("./dashboard/views/footer/footerNormal.html", $data = ["name" => $path]);
                $sidebar = new Template("./dashboard/views/sidebarUserS.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Listado de productos',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/free/listP.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => $content,
                    "footer" => $footer
                ]);
                echo $template;
                break;
            case 'borrarCuenta':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $footer = new Template("./dashboard/views/footer/footerNormal.html", $data = ["name" => $path]);
                $sidebar = new Template("./dashboard/views/sidebarUserS.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Eliminación de cuenta',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/free/eliminarCuenta.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => $content,
                    "footer" => $footer
                ]);
                echo $template;
                break;

            default:
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $sidebar = new Template("./dashboard/views/sidebarUserS.html");
                $footer = new Template("./dashboard/views/footer/footerNormal.html", $data = ["name" => $path]);
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Registro de pedidos',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/free/general.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => $content,
                    "footer" => $footer
                ]);
                echo $template;
                break;
        }
    }
    public function deliver($path, $user, $idUser, $types)
    {
        switch ($path) {
            case 'borrarCuenta':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $footer = new Template("./dashboard/views/footer/footerdeliver.html");
                $sidebar = new Template("./dashboard/views/sidebarUserS.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Eliminación de cuenta',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/free/eliminarCuenta.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => $content,
                    "footer" => $footer
                ]);
                echo $template;
                break;
            case 'pedidos':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $sidebar = new Template("./dashboard/views/sidebarDeliver.html");
                $footer = new Template("./dashboard/views/footer/footerdeliver.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Pedidos',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/deliver/pedidos.html", $data = [
                    "nav" => $nav,
                    "user" => $user,
                    "idToken" => $idUser

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => $content,
                    "footer" => $footer
                ]);
                echo $template;
                break;
            case 'tiendas':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $sidebar = new Template("./dashboard/views/sidebarDeliver.html");
                $footer = new Template("./dashboard/views/footer/footerdeliver.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Anexar tienda',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/deliver/stores.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => $content,
                    "footer" => $footer
                ]);
                echo $template;

                break;
            case 'porfile':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $sidebar = new Template("./dashboard/views/sidebarDeliver.html");
                $footer = new Template("./dashboard/views/footer/footerdeliver.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Mi perfil',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/deliver/porfile.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => $content,
                    "footer" => $footer
                ]);
                echo $template;
                break;
            default:
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $sidebar = new Template("./dashboard/views/sidebarDeliver.html");
                $footer = new Template("./dashboard/views/footer/footerdeliver.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Anexar tienda',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/deliver/stores.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => $content,
                    "footer" => $footer
                ]);
                echo $template;

                break;
        }
    }
    public function client($path, $user, $idUser, $types)
    {
        switch ($path) {
            case 'borrarCuenta':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $footer = new Template("./dashboard/views/footer/footerCliente.html");
                $sidebar = new Template("./dashboard/views/sidebarUserS.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Eliminación de cuenta',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/free/eliminarCuenta.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => $content,
                    "footer" => $footer
                ]);
                echo $template;
                break;
            case 'historial':
                $head = new Template("./dashboard/views/headerFree.html", $data = [
                    "type" => $types,
                    "idToken" => $idUser
                ]);
                $footer = new Template("./dashboard/views/footer/footerCliente.html");
                $nav = new Template("./dashboard/views/free/navFree.html", $data = [
                    "type" => $types,
                    "tittle" => 'Historial de compras',
                    "user" => $user

                ]);
                $content = new Template("./dashboard/views/cliente/history.html", $data = [
                    "nav" => $nav,
                    "user" => $user

                ]);
                $template = new Template("./dashboard/views/index.html", $data = [
                    "head" => $head,

                    "content" => $content,
                    "footer" => $footer
                ]);
                echo $template;
                break;

            default:
                header('Location: ' . "/@310");

                break;
        }
    }
}
