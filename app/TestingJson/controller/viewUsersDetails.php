<?php
require('../class/app.php');
$objet = new app;
$id = (isset($_POST['id']) ? $_POST['id'] : null);
$objet -> getDetailsUser($id);