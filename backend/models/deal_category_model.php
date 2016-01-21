<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Deal_Category_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function load_all_deal_category($num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('deal_category');
        $this->db->order_by('ordering');
		$result = $this->db->get();	
		return $result->result();
	}
	
	function get_all(){
		$result = $this->db->count_all('deal_category');
		return $result;
	}
	
	function add_deal_category($data){

		$config['upload_path'] = get_config_value('upload_deal_category_path');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= get_config_value('max_size');
		$config['encrypt_name']	= TRUE;    // rename to random string

		if($_FILES['white_icon']['name']){
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('white_icon')){	
				$datax1 = $this->upload->data();
			} else {
				print_r($this->upload->display_errors());exit;
			}
		} else {
			$datax1['file_name'] = NULL;				
		}
        
        if($_FILES['red_icon']['name']){
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('red_icon')){	
				$datax2 = $this->upload->data();
			} else {
				print_r($this->upload->display_errors());exit;
			}
		} else {
			$datax2['file_name'] = NULL;				
		}
        
        $ordering = $this->get_max_ordering() + 1;
        
		$this->db->set('name',	$data['name']);
		$this->db->set('alias',	seo_url($data['name']));
		$this->db->set('white_icon', $datax1['file_name']);
        $this->db->set('red_icon', $datax2['file_name']);
		$this->db->set('time',	time());
		$this->db->set('publish',	1);
        $this->db->set('ordering',	$ordering);
		
		$result = $this->db->insert('deal_category');
		return $result;
	}
	
	function delete_deal_category($id){
		$arr = array('id' => $id);
		$this->db->select('white_icon, red_icon');
		$result = $this->db->get('deal_category', $arr);
		$white_icon = $result->row()->white_icon;
        $red_icon = $result->row()->red_icon;

		$result = $this->db->delete('deal_category', $arr);
		if($result){
			if(!unlink('upload/deal_category/'.$white_icon)){
				return false;
			}
            if(!unlink('upload/deal_category/'.$red_icon)){
				return false;
			}
		}
		return $result;
	}
    
    function get_max_ordering(){
        $this->db->select_max('ordering');
        $result = $this->db->get('deal_category');

        return $result->row()->ordering;
    }
    
    function load_deal_category($id){
        $this->db->select('*');
        $this->db->where('id', $id);
        $result = $this->db->get('deal_category');
        
        return $result->row();
    }
    
    function update_deal_category(){
		if($_FILES['white_icon']['name']){
			$white_icon = $this->load_white_icon_name($this->input->post('id'));
			unlink('upload/deal_category/'.$white_icon);
			$config['upload_path'] = get_config_value('upload_deal_category_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= get_config_value('max_size');
			$config['encrypt_name']	= TRUE;    // rename to random string
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('white_icon')){
				$datax = $this->upload->data();
				$this->db->set('white_icon',	$datax['file_name']);
			} else {
				print_r($this->upload->display_errors());exit;
			}
		}
        
        if($_FILES['red_icon']['name']){
			$red_icon = $this->load_red_icon_name($this->input->post('id'));
			unlink('upload/deal_category/'.$red_icon);
			$config['upload_path'] = get_config_value('upload_deal_category_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= get_config_value('max_size');
			$config['encrypt_name']	= TRUE;    // rename to random string
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('red_icon')){
				$datax = $this->upload->data();
				$this->db->set('red_icon',	$datax['file_name']);
			} else {
				print_r($this->upload->display_errors());exit;
			}
		}
		
		$this->db->set('name', $this->input->post('name'));
		$this->db->set('alias', seo_url($this->input->post('name')));
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update('deal_category');
		return $result;
	}
    
    function load_white_icon_name($id){
		$this->db->select('white_icon');
		$this->db->where('id', $id);
		$result = $this->db->get('deal_category');
		return $result->row()->white_icon;
	}
    
    function load_red_icon_name($id){
		$this->db->select('red_icon');
		$this->db->where('id', $id);
		$result = $this->db->get('deal_category');
		return $result->row()->red_icon;
	}
}