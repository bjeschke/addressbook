<?php
require_once(dirname(dirname(__FILE__))."/classes/controller.php");
require_once(dirname(dirname(__FILE__))."/classes/class_user.php");

$controller = new Controller($id);  

$userAmount = $controller->getUserAmount(); 

echo $userAmount;

?>