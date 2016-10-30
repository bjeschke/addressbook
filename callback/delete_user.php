<?php
require_once(dirname(dirname(__FILE__))."/classes/controller.php");
require_once(dirname(dirname(__FILE__))."/classes/class_user.php");

$id = $_POST['id'];

$controller = new Controller($id);  
$userData = $controller->deleteUser($id); 

echo json_encode($userData);

?>