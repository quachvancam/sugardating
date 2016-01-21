<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Slideshow_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function load_all_slideshow($num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('slideshow');
        $this->db->order_by('ordering');
		$result = $this->db->get();	
		return $result->result();
	}
	
	function get_all(){
		$result = $this->db->count_all('slideshow');
		return $result;
	}
	
	function add_slideshow($data){

		$config['upload_path'] = get_config_value('upload_slideshow_path');
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
			$datax['file_name'] = "";				
		}
        
        $ordering = $this->get_max_ordering() + 1;
        
		$this->db->set('title',	$data['title']);
		$this->db->set('alias',	seo_url($data['title']));
		$this->db->set('image', $datax['file_name']);
        $this->db->set('link_path', $this->input->post('link_path'));
		$this->db->set('publish',	1);
        $this->db->set('ordering',	$ordering);
		
		$result = $this->db->insert('slideshow');
		return $result;
	}
	
	function delete_image($id){
		$arr = array('id' => $id);
		$this->db->select('image');
		$result = $this->db->get('slideshow', $arr);
		$image = $result->row()->image;

		$result = $this->db->delete('slideshow', $arr);
		if($result){
			if(!unlink('upload/slideshow/'.$image)){
				return false;
			}
		}
		return $result;
	}
    
    function get_max_ordering(){
        $this->db->select_max('ordering');
        $result = $this->db->get('slideshow');

        return $result->row()->ordering;
    }
    
    function load_slideshow($id){
        $this->db->select('*');
        $this->db->where('id', $id);
        $result = $this->db->get('slideshow');
        
        return $result->row();
    }
    
    function update_slideshow($id){
		if($_FILES['image']['name']){
			$image = $this->load_image_name($this->input->post('id'));
			unlink('upload/slideshow/'.$image);
			$config['upload_path'] = get_config_value('upload_slideshow_path');
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
		$result = $this->db->update('slideshow');
		return $result;
	}
    
    function load_image_name($id){
		$this->db->select('image');
		$this->db->where('id', $id);
		$result = $this->db->get('slideshow');
		return $result->row()->image;
	}
}