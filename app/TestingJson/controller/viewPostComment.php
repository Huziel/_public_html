<?php
require('../class/app.php');
$objet = new app;
$id = (isset($_POST['id']) ? $_POST['id'] : null);
$userData = (isset($_POST['userData']) ? $_POST['userData'] : null);
$objet -> getComments($id,$userData);