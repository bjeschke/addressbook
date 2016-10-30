<?php

require_once(dirname(dirname(__FILE__))."/_include/database.php");

class class_User
{

	/*
	 * Constructor
	*/
  public function __construct() {
    $this->db = new UserDataBase(); 
  }

	/*
	 * return list of user in database
	*/
	public function getUserOverview($showUserStart,$maxUserPage) {
		$result = $this->db->get_result('SELECT id,firstname, lastname FROM addressbook LIMIT '.$showUserStart.','.$maxUserPage);

		return $result;
	}
	
	/*
	 * return amount of users in database
	*/
	public function getUserAmount() {
		$result = $this->db->get_result('SELECT COUNT(*) as count FROM addressbook');

		return $result[0]["count"];
	}
			
	/*
	 * return details of one user of database
	 * get user data from table: adressbook
	 * get state data from table: state
	*/
	public function getUserDetail($user_id) {
		$result_user = $this->db->get_result('SELECT * FROM addressbook WHERE id = '.$user_id);
				
		$result_state = $this->db->get_result('SELECT * FROM states WHERE id = '.$result_user[0]["state"]);
		         
    $result_user[0]["state"] = $result_state[0]["name"];
   
		return $result_user[0];
	}
	
	/*
	 * update user data
	 * return the new user data
	*/	
	public function editUserDetail($id,$firstname,$lastname,$number,$street,$suburb,$state) {
		$userdata = $this->db->get_result('SELECT * FROM addressbook WHERE id = '.$id);
		$stateID = $this->db->get_result('SELECT id FROM states WHERE name = "'.$state.'"');
	
		if($userdata[0] != "")
		{
			$state = $this->db->insert('UPDATE addressbook SET firstname = "'.$firstname.'",
																												 lastname = "'.$lastname.'",
																												 number = "'.$number.'",
																												 street = "'.$street.'",
																												 suburb = "'.$suburb.'",
																												 state = "'.$stateID[0]["id"].'" WHERE id = '.$id);
		}	 						
		
		$result_user = $this->db->get_result('SELECT * FROM addressbook WHERE id = '.$id); 
		$result_state = $this->db->get_result('SELECT * FROM states WHERE id = '.$result_user[0]["state"]);         
    $result_user[0]["state"] = $result_state[0]["name"];		
    												
		return $result_user[0];
	}
	
	
	/*
	 * delete user from database
	 * return state (bool)
	*/	
	public function deleteUser($id) {
		$state = $this->db->insert('DELETE * FROM addressbook WHERE id = '.$id);
		
		return $state;
	}

}