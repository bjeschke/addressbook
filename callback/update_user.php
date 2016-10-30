<?php
require_once(dirname(dirname(__FILE__))."/classes/controller.php");
require_once(dirname(dirname(__FILE__))."/classes/class_user.php");

$id = $_POST['id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$number = $_POST['number'];
$street = $_POST['street'];
$suburb = $_POST['suburb'];
$state = $_POST['state'];

$controller = new Controller();  

// Load user detail data
$userData = $controller->updateUser($id,$firstname,$lastname,$number,$street,$suburb,$state); 

// Send back all user data by JSON String
echo json_encode($userData);

?>