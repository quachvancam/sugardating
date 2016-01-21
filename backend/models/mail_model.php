<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Mail_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function load_all_mail(){
		$result = $this->db->get('mail_template');
		return $result->result();
	}
	
	function load_mail($id){
		$where = array('id' => $id);
		$result = $this->db->get_where('mail_template', $where);
		return $result->row();
	}
	
	function update_mail($data){
		$arr = array('title'=>$data['title'], 'content'=>$data['content']);
		$this->db->where('id', $data['id']);
		$result = $this->db->update('mail_template', $arr);
		return $result;
	}
	
	function add_mail($data){
		$arr = array('title'=>$data['title'], 'content'=>$data['content'], 'publish'=>1);
		$result = $this->db->insert('mail_template', $arr);
		return $result;
	}
	
	function delete_mail($id){
		$arr = array('id'=>$id);
		$result = $this->db->delete('mail_template', $arr);
		return $result;
	}
}