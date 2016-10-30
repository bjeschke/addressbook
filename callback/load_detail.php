<?php
require_once(dirname(dirname(__FILE__))."/classes/controller.php");
require_once(dirname(dirname(__FILE__))."/classes/class_user.php");

// ID for detail information
$id = $_POST['id'];

$controller = new Controller();  

// Load user detail data
$userData = $controller->loadUserDetail($id); 

// Send back all user data by JSON String
echo json_encode($userData);

?>