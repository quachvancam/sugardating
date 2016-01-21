<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Blog_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function load_all_blog($user_id, $num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('blog');
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
    
    function load_blog($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		$result = $this->db->get('blog');
		return $result->row();
	}
	
	function get_all($user_id){
		$this->db->where('user_id', $user_id);
        $this->db->from('blog');
		$result = $this->db->count_all_results();
		return $result;
	}
	
	function add_blog($data){
		$config['upload_path'] = get_config_value('upload_blog_path');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= get_config_value('max_size');
		$config['encrypt_name']	= TRUE;    // rename to random string

		$this->load->library('upload', $config);

		if($_FILES['image']['name']){
			if ($this->upload->do_upload('image')){	
				$datax = $this->upload->data();
			} else {
				die($this->upload->display_errors());
			}
		} else {
			$datax['file_name'] = NULL;				
		}
		
		$this->db->set('user_id',	$data['user_id']);
        $this->db->set('title',	$data['title']);
        $this->db->set('alias',	seo_url($data['title']));
        $this->db->set('content',	$data['content']);
		$this->db->set('image',		$datax['file_name']);
		$this->db->set('time',		time());
		$this->db->set('publish',	1);
		
		$result = $this->db->insert('blog');
		return $result;
	}
    
    function update_blog(){
		if($_FILES['image']['name']){
			$image = $this->load_image_name($this->input->post('id'));
			unlink('upload/images/'.$image);
			$config['upload_path'] = get_config_value('upload_blog_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= get_config_value('max_size');
			$config['encrypt_name']	= TRUE;    // rename to random string
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('image')){
				$datax = $this->upload->data();
				$this->db->set('image',	$datax['file_name']);
			} else {
				print_r($this->upload->display_errors());exit;
			}
		}
		
		$this->db->set('title', $this->input->post('title'));
		$this->db->set('alias', seo_url($this->input->post('title')));
		$this->db->set('content', $this->input->post('content'));
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update('blog');
		return $result;
	}
    
    function load_image_name($id){
		$this->db->select('image');
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->get('blog');
		return $result->row()->image;
	}
	
	function delete_blog($id){
		$arr = array('id' => $id);
		$this->db->select('image');
		$result = $this->db->get('blog', $arr);
		$image = $result->row()->image;

		$result = $this->db->delete('blog', $arr);
		if($result){
			if(!unlink('upload/blog/'.$image)){
				return false;
			}
		}
		return $result;
	}
}