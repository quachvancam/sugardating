<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Blog_Model extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function load_user_name($user_id){
		$this->db->select('name');
		$this->db->where('id', $user_id);
		$result = $this->db->get('user');
		return $result->row()->name;
	}
    
    function load_all_blog($id, $num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('blog');
        $this->db->where('user_id', $id);
        $this->db->order_by('time DESC');
		$result = $this->db->get();		

		return $result->result();
	}
    
    function get_all($id){
        $this->db->select('COUNT(*) as num');
		$this->db->where('user_id', $id);
		$result = $this->db->get('blog');
		return $result->row()->num;
	}
    
    function load_blog($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		$result = $this->db->get('blog');
		return $result->row();
	}
}