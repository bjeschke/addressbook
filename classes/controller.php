<?php
	class Controller{  
  
    private $request = null;  
  
  	/* 
  	 * Constructor
  	*/
    public function __construct($request){  
      $this->request = $request;  
      $this->maxUserPage = 5; 
    }  
    
    /* 
  	 * load users for page
  	 * @param page
  	*/
    public function loadOverview($page) {
     	$_user = new class_User();
     	
     	$showUserStart = ($page-1) * $this->maxUserPage;

    	$user = $_user->getUserOverview($showUserStart,$this->maxUserPage);
    	
    	return $user;
    }
    
    
    /* 
  	 * load details from user
  	*/
    public function loadUserDetail($id) {
    	$_user = new class_User();
    
    	$user = $_user->getUserDetail($id);
    
    	return $user;
    }
    
    /* 
  	 * load amount of user in database
  	*/
    public function getUserAmount() {
    	$_user = new class_User();
    
    	$userAmount = $_user->getUserAmount();
    
    	return $userAmount;
    }
    
    
    /* 
  	 * delete user from database
  	*/
    public function deleteUser($id) {
    	$_user = new class_User();
    
    	$state = $_user->deleteUser($id);
    
    	return $state;
    }
    
    
    /* 
  	 * update user data
  	*/
    public function updateUser($id,$firstname,$lastname,$number,$street,$suburb,$state) {
    	$_user = new class_User();
    
    	$user = $_user->editUserDetail($id,$firstname,$lastname,$number,$street,$suburb,$state);
    
    	return $user;
    }
    
	} 
?>
