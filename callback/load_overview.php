<?php
require_once(dirname(dirname(__FILE__))."/classes/controller.php");
require_once(dirname(dirname(__FILE__))."/classes/class_user.php");

$page = $_POST['page'];

$controller = new Controller();  

$userData = $controller->loadOverview($page); 

echo json_encode($userData);

?>