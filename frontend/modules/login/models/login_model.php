<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Login_Model extends MX_Controller { 
    public function __construct() {
        parent::__construct(); 
    }
     
    function get_message_num($id){
        $this->db->select('COUNT(*) num');
        $this->db->from('messages');
		$this->db->where('to_id', $id);
        $this->db->where('seen', 0);
		$result = $this->db->get();
		return $result->row()->num;
    }
}