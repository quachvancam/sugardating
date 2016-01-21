<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Config_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function load_all_config(){
		$result = $this->db->get('config');
		return $result->result();
	}
	
	function load_config($id){
		$where = array('id' => $id);
		$result = $this->db->get_where('config', $where);
		return $result->row();
	}
	
	function update_config($data){
		$arr = array('name'=>$data['name'], 'config'=>$data['config'], 'value'=>$data['value']);
		$this->db->where('id', $data['id']);
		$result = $this->db->update('config', $arr);
		return $result;
	}
	
	function add_config($data){
		$arr = array('name'=>$data['name'], 'config'=>$data['config'], 'value'=>$data['value']);
		$result = $this->db->insert('config', $arr);
		return $result;
	}
	
	function delete_config($id){
		$arr = array('id'=>$id);
		$result = $this->db->delete('config', $arr);
		return $result;
	}
	
	function check_config($config){
		$this->db->select('id');
		$this->db->where('config', $config);
		$result = $this->db->get('config');
		return $result->row();
	}
}