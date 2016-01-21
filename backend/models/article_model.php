<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Article_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function load_all_article($num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('article.*, category.name AS category_name');
		$this->db->from('article');
		$this->db->join('category', 'article.category_id = category.id');
        $this->db->order_by('article.ordering');
		$result = $this->db->get();	
		return $result->result();
	}
	
	function load_article($id){
		$this->db->where('id', $id);
		$result = $this->db->get('article');
		return $result->row();
	}
	
	function count_all(){
		$result = $this->db->count_all('article');
		return $result;
	}
	
	function load_categories(){
		$this->db->select("id, name");
		$result = $this->db->get('category');
		return $result->result();
	}
	
	function add_article($data){

		$config['upload_path'] = get_config_value('upload_news_path');
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
		
		$this->db->set('title',	$data['title']);
		$this->db->set('alias',	seo_url($data['title']));
		$this->db->set('category_id', $data['category_id']);
		$this->db->set('image', $datax['file_name']);
		$this->db->set('short_content',	$data['short_content']);
		$this->db->set('full_content',	$data['full_content']);
		$this->db->set('time',	time());
		$this->db->set('publish',	1);
		
		$result = $this->db->insert('article');
		return $result;
	}
	
	function update_article($id=NULL, $data=NULL){
		$this->db->where('id', $id);
        $this->db->update('article', $data);
        return true;
	}
	
	function delete_article($id){
		$arr = array('id' => $id);
        $this->db->select('image');
		$result = $this->db->get('article', $arr);
		$image = $result->row()->image;
        
		$result = $this->db->delete('article', $arr);
        if($result){
			if(!unlink('upload/news/'.$image)){
				return false;
			}
		}
		return $result;
	}
	
	function load_image_name($id){
		$this->db->select('image');
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->get('article');
		return $result->row()->image;
	}
    
    function load_search_article($num, $offset, $kw){
		$this->db->limit($num, $offset);
		$this->db->select('article.*, category.name AS category_name');
		$this->db->from('article');
		$this->db->join('category', 'article.category_id = category.id');
        $this->db->like('title', $kw);
		$result = $this->db->get();	
		return $result->result();
	}
    
    function count_search_all($kw){
        $this->db->like('title', $kw);
		$result = $this->db->count_all('article');
		return $result;
	}
}