<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Banner_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function load_all_banner($num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('banner');
        $this->db->order_by('ordering');
		$result = $this->db->get();	
		return $result->result();
	}
	
	function get_all(){
		$result = $this->db->count_all('banner');
		return $result;
	}
	
	function add_banner($data){

		$config['upload_path'] = get_config_value('upload_banner_path');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= get_config_value('max_size');
		$config['encrypt_name']	= TRUE;    // rename to random string

		if($_FILES['image']['name']){
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('image')){	
				$datax = $this->upload->data();
			} else {
				print_r($this->upload->display_errors());exit;
			}
		} else {
			$datax['file_name'] = NULL;				
		}
        
        $ordering = $this->get_max_ordering() + 1;
        
		$this->db->set('title',	$data['title']);
		$this->db->set('alias',	seo_url($data['title']));
		$this->db->set('image', $datax['file_name']);
        $this->db->set('link_path', $this->input->post('link_path'));
		$this->db->set('publish',	1);
        $this->db->set('ordering',	$ordering);
		
		$result = $this->db->insert('banner');
		return $result;
	}
	
	function delete_banner($id){
		$arr = array('id' => $id);
		$this->db->select('image');
		$result = $this->db->get('banner', $arr);
		$image = $result->row()->image;

		$result = $this->db->delete('banner', $arr);
		if($result){
			if(!unlink('upload/banner/'.$image)){
				return false;
			}
		}
		return $result;
	}
    
    function get_max_ordering(){
        $this->db->select_max('ordering');
        $result = $this->db->get('banner');

        return $result->row()->ordering;
    }
    
    function load_banner($id){
        $this->db->select('*');
        $this->db->where('id', $id);
        $result = $this->db->get('banner');
        
        return $result->row();
    }
    
    function update_banner($id){
		if($_FILES['image']['name']){
			$image = $this->load_image_name($this->input->post('id'));
			unlink('upload/banner/'.$image);
			$config['upload_path'] = get_config_value('upload_banner_path');
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
        $this->db->set('link_path', $this->input->post('link_path'));
		$this->db->where('id', $id);
		$result = $this->db->update('banner');
		return $result;
	}
    
    function load_image_name($id){
		$this->db->select('image');
		$this->db->where('id', $id);
		$result = $this->db->get('banner');
		return $result->row()->image;
	}
}