<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Gallery_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function load_all_image($user_id, $num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('gallery');
		$this->db->where('user_id', $user_id);
		$result = $this->db->get();	
		return $result->result();
	}
	
	function load_user_name($user_id){
		$this->db->select('name');
		$this->db->where('id', $user_id);
		$result = $this->db->get('user');
		return $result->row()->name;
	}
	
	function get_all($user_id){
		$this->db->where('user_id', $user_id);
        $this->db->from('gallery');
		$result = $this->db->count_all_results();
		return $result;
	}
	
	function add_image($user_id){
		$config['upload_path'] = get_config_value('upload_gallery_path');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= get_config_value('max_size');
		$config['encrypt_name']	= TRUE;    // rename to random string

		$this->load->library('upload', $config);

		if($_FILES['upl']['name']){
			if ($this->upload->do_upload('upl')){	
				$datax = $this->upload->data();
			} else {
				die($this->upload->display_errors());
			}
		} else {
			$datax['file_name'] = NULL;				
		}
		
		$this->db->set('user_id',	$user_id);
		$this->db->set('image',		$datax['file_name']);
		$this->db->set('time',		time());
		$this->db->set('publish',	1);
		
		$result = $this->db->insert('gallery');
		return $result;
	}
	
	function delete_image($id){
		$arr = array('id' => $id);
		$this->db->select('image');
		$result = $this->db->get('gallery', $arr);
		$image = $result->row()->image;

		$result = $this->db->delete('gallery', $arr);
		if($result){
			if(!unlink('upload/gallery/'.$image)){
				return false;
			}
		}
		return $result;
	}
}