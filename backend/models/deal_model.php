<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Deal_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function load_all_deal($num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('deal.*, b2b.company AS company_name, dc.name as category_name');
		$this->db->from('deal');
        $this->db->join('b2b_user as b2b', 'deal.b2b_id = b2b.id');
        $this->db->join('deal_category as dc', 'deal.category_id = dc.id');
        $this->db->order_by('expiry, ordering');
		$result = $this->db->get();	
		return $result->result();
	}
	
	function load_deal($id){
		$this->db->where('id', $id);
		$result = $this->db->get('deal');
		return $result->row();
	}
	
	function count_all(){
		$result = $this->db->count_all('deal');
		return $result;
	}
	
	function load_b2b(){
		$this->db->select("*");
		$result = $this->db->get('b2b_user');
		return $result->result();
	}
    
    function load_categories(){
		$this->db->select("*");
        $this->db->order_by('ordering');
		$result = $this->db->get('deal_category');
		return $result->result();
	}
	
	function add_deal(){
		$config['upload_path'] = get_config_value('upload_deal_path');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= get_config_value('max_size');
		$config['encrypt_name']	= TRUE;    // rename to random string

		if($_FILES['image1']['name']){
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('image1')){	
				$datax1 = $this->upload->data();
			} else {
				print_r($this->upload->display_errors());exit;
			}
		} else {
			$datax1['file_name'] = NULL;				
		}
        
        if($_FILES['image2']['name']){
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('image2')){	
				$datax2 = $this->upload->data();
			} else {
				print_r($this->upload->display_errors());exit;
			}
		} else {
			$datax2['file_name'] = NULL;				
		}
        
        if($_FILES['image3']['name']){
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('image3')){	
				$datax3 = $this->upload->data();
			} else {
				print_r($this->upload->display_errors());exit;
			}
		} else {
			$datax3['file_name'] = NULL;				
		}
        
        if($_FILES['image4']['name']){
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('image4')){	
				$datax4 = $this->upload->data();
			} else {
				print_r($this->upload->display_errors());exit;
			}
		} else {
			$datax4['file_name'] = NULL;				
		}
        
        $tmp = explode('-', $this->input->post('date'));
        $end_date = mktime($this->input->post('hour'), $this->input->post('minute'), 0, $tmp[1], $tmp[0], $tmp[2]);
        $ordering = $this->get_max_ordering() + 1;
		
		$this->db->set('name',	$this->input->post('name'));
		$this->db->set('alias',	seo_url($this->input->post('name')));
		$this->db->set('category_id', $this->input->post('category_id'));
        $this->db->set('b2b_id',	$this->input->post('b2b_id'));
        $this->db->set('title',	$this->input->post('title'));
        $this->db->set('description',	$this->input->post('description'));
        $this->db->set('old_price',	$this->input->post('old_price'));
        $this->db->set('new_price',	$this->input->post('new_price'));
        $this->db->set('quantity',	$this->input->post('quantity'));
        $this->db->set('end_date',	$end_date);
        
        $this->db->set('image1',	$datax1['file_name']);
        $this->db->set('image2',	$datax2['file_name']);
        $this->db->set('image3',	$datax3['file_name']);
        $this->db->set('image4',	$datax4['file_name']);
	
		$this->db->set('time',	time());
		$this->db->set('publish',	1);
        $this->db->set('expiry',	0);
        $this->db->set('ordering',	$ordering);
		
		$result = $this->db->insert('deal');
		return $result;
	}
    
    function get_max_ordering(){
        $this->db->select_max('ordering');
        $result = $this->db->get('deal');

        return $result->row()->ordering;
    }
	
	function update_deal(){
		if($_FILES['image1']['name']){
			$image = $this->load_image_name($this->input->post('id'));
			unlink('upload/deal/'.$image->image1);
			$config['upload_path'] = get_config_value('upload_deal_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= get_config_value('max_size');
			$config['encrypt_name']	= TRUE;    // rename to random string
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('image1')){
				$datax = $this->upload->data();
				$this->db->set('image1',	$datax['file_name']);
			} else {
				print_r($this->upload->display_errors());exit;
			}
		}
        
        if($_FILES['image2']['name']){
			$image = $this->load_image_name($this->input->post('id'));
			unlink('upload/deal/'.$image->image2);
			$config['upload_path'] = get_config_value('upload_deal_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= get_config_value('max_size');
			$config['encrypt_name']	= TRUE;    // rename to random string
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('image2')){
				$datax = $this->upload->data();
				$this->db->set('image2',	$datax['file_name']);
			} else {
				print_r($this->upload->display_errors());exit;
			}
		}
        
        if($_FILES['image3']['name']){
			$image = $this->load_image_name($this->input->post('id'));
			unlink('upload/deal/'.$image->image3);
			$config['upload_path'] = get_config_value('upload_deal_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= get_config_value('max_size');
			$config['encrypt_name']	= TRUE;    // rename to random string
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('image3')){
				$datax = $this->upload->data();
				$this->db->set('image3',	$datax['file_name']);
			} else {
				print_r($this->upload->display_errors());exit;
			}
		}
        
        if($_FILES['image4']['name']){
			$image = $this->load_image_name($this->input->post('id'));
			unlink('upload/deal/'.$image->image4);
			$config['upload_path'] = get_config_value('upload_deal_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= get_config_value('max_size');
			$config['encrypt_name']	= TRUE;    // rename to random string
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('image4')){
				$datax = $this->upload->data();
				$this->db->set('image4',	$datax['file_name']);
			} else {
				print_r($this->upload->display_errors());exit;
			}
		}
        
        $tmp = explode('-', $this->input->post('date'));
        $end_date = mktime($this->input->post('hour'), $this->input->post('minute'), 0, $tmp[1], $tmp[0], $tmp[2]);
		
		$this->db->set('name',	$this->input->post('name'));
		$this->db->set('alias',	seo_url($this->input->post('name')));
		$this->db->set('category_id', $this->input->post('category_id'));
        $this->db->set('b2b_id',	$this->input->post('b2b_id'));
        $this->db->set('title',	$this->input->post('title'));
        $this->db->set('description',	$this->input->post('description'));
        $this->db->set('old_price',	$this->input->post('old_price'));
        $this->db->set('new_price',	$this->input->post('new_price'));
        $this->db->set('quantity',	$this->input->post('quantity'));
        $this->db->set('end_date',	$end_date);
		$this->db->where('id',	$this->input->post('id'));
		$result = $this->db->update('deal');
		return $result;
	}
	
	function delete_deal($id){
		$arr = array('id' => $id);
		$image = $this->load_image_name($id);
        
		$result = $this->db->delete('deal', $arr);
        if($result){
			unlink('upload/deal/'.$image->image1);
            unlink('upload/deal/'.$image->image2);
            unlink('upload/deal/'.$image->image3);
            unlink('upload/deal/'.$image->image4);
		}
		return $result;
	}
    
    function delete_image($image, $id){
		
        $this->db->set($image, "");
		$this->db->where('id', $id);
		$result = $this->db->update('deal');
		return $result;
	}
	
	function load_image_name($id){
		$this->db->select('image1, image2, image3, image4');
		$this->db->where('id', $id);
		$result = $this->db->get('deal');
		return $result->row();
	}
    
    function load_search_deal($num, $offset, $kw){
		$this->db->limit($num, $offset);
		$this->db->select('deal.*, b2b.company AS company_name, dc.name as category_name');
		$this->db->from('deal');
        $this->db->join('b2b_user as b2b', 'deal.b2b_id = b2b.id');
        $this->db->join('deal_category as dc', 'deal.category_id = dc.id');
        $this->db->like('deal.name', $kw);
        $this->db->order_by('expiry DESC, end_date'); 
		$result = $this->db->get();
		return $result->result();
	}
    
    function count_search_all($kw){
        $this->db->like('name', $kw);
		$result = $this->db->count_all('deal');
		return $result;
	}
}