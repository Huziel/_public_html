

<?php
session_start();
require_once('models/app.php');
$view = new app;
$view = $view->route();
