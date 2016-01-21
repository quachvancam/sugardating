<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Admin_User_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function load_all_admin(){
		$query = "SELECT id, name, email, last_login, publish FROM admin";
		$users = $this->db->query($query);
		return $users->result();
	}
	
	function load_admin($id){
		$query = "SELECT id, name, email FROM admin WHERE id = ".$id;
		$user = $this->db->query($query);
		return $user->row();
	}
	
	function update_admin($id, $name, $new_pass = NULL){
		if($new_pass){
			$pass_str = ", password = '".md5($new_pass)."'";
		}
		$query = "UPDATE admin SET name = '".$name."'".$pass_str." WHERE id = ".$id;
		$result = $this->db->query($query);
		return $result;
	}
	
	function add_admin($name, $email, $pass){
		$query = "INSERT INTO admin (email, password, name, time, publish)VALUES ('".$email."', '".md5($pass)."', '".$name."', ".time().", 1)";
		$result = $this->db->query($query);
		return $result;
	}
	
	function update_status($table, $id, $status){
		$query = "UPDATE ".$table." SET publish = ".$status." WHERE id = ".$id;
		$result = $this->db->query($query);
		return $result;
	}
	
	function delete_admin($id){
		$query = "DELETE FROM admin WHERE id = ".$id;
		$result = $this->db->query($query);
		return $result;
	}
	
	function check_admin($email){
		$query = "SELECT id FROM admin WHERE email = '".$email."'";
		$user = $this->db->query($query);
		return $user->row();
	}
}