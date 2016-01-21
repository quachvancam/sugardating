<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Profile_Model extends MX_Controller { 
    public function __construct() {
        parent::__construct(); 
    }
     
    function get_user_from_id($id){
        $this->db->select('*');
		$this->db->where('id', $id);
		$result = $this->db->get('user');
		return $result->row();
    }
}