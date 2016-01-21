<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Category_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function load_all_category($num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('category');
		$result = $this->db->get();	
		return $result->result();
	}
	
	function load_category($user_id){
		$this->db->where('id', $user_id);
		$result = $this->db->get('category');
		return $result->row();
	}
	
	function count_all(){
		$result = $this->db->count_all('category');
		return $result;
	}
	
	function add_category($data){
		$this->db->set('name',	$data['name']);
		$this->db->set('alias',	seo_url($data['name']));
		$this->db->set('time',		time());
		$this->db->set('publish',	1);
		
		$result = $this->db->insert('category');
		return $result;
	}
	
	function update_category($data){
		$this->db->set('name', $data['name']);
		$this->db->set('alias', seo_url($data['name']));
		$this->db->where('id', $data['id']);
		$result = $this->db->update('category');
		return $result;
	}
	
	function delete_category($id){
		$arr = array('id' => $id);
		$result = $this->db->delete('category', $arr);
		return $result;
	}
}