<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('article_model');
    }

	function index()
	{
		$config['base_url'] = base_url().index_page().'/article/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] =$this->article_model->count_all();
		$this->pagination->initialize($config);
		
		$data['articles'] = $this->article_model->load_all_article($config['per_page'], $this->uri->segment(3));
		$data['all_link']=$this->pagination->create_links();
		
        $data['title'] = "Article List";
	    $data['content'] = 'article/article_list';
		$this->load->view('template',$data,'');
	}
	
	function add(){
		$data['title'] = "Add Article";
		$data['categories'] = $this->article_model->load_categories();
		$data['content'] = 'article/article_add';
		$this->load->view('template',$data,'');
	}
	
	function edit($id = NULL){
		$data['article'] = $this->article_model->load_article($id);
		$data['categories'] = $this->article_model->load_categories();
		$data['title'] = "Edit Article";
		
		$data['content'] = 'article/article_edit';
		$this->load->view('template',$data,'');
	}
	
	function delete(){
		$ids = $this->input->post('id');
		foreach($ids as $id){
			$isOK = $this->article_model->delete_article($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect('/article');
			}
		}
		$this->session->set_flashdata('message', 'Selected value is deleted');
	    redirect('/article');
	}

	function save_add(){
		$data['title'] = $this->input->post('title');
		$data['category_id'] = $this->input->post('category_id');
		$data['short_content'] = $this->input->post('short_content');
		$data['full_content'] = $this->input->post('full_content');
		
		$isOK = $this->article_model->add_article($data);
		if($isOK){
			$this->session->set_flashdata('message', 'A article is added');
	    	redirect('/article');
		} else {
			$this->session->set_flashdata('message', 'Can\'t add article');
	    	redirect('/article');
		}
	}
	
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect('/article');
	}
	
	function save_edit(){
       if($_FILES['image']['name']){
			$image = $this->article_model->load_image_name($this->input->post('id'));
			unlink('upload/images/'.$image);
			$config['upload_path'] = get_config_value('upload_news_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= get_config_value('max_size');
			$config['encrypt_name']	= TRUE;    // rename to random string
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('image')){
				$datax = $this->upload->data();
				$data['image'] = $datax['file_name'];
			} else {
				print_r($this->upload->display_errors());exit;
			}
		}
        $data['title'] = $this->input->post('title');
        $data['alias'] = seo_url($this->input->post('title'));
        $data['category_id'] = $this->input->post('category_id');
        $data['short_content'] = html_entity_decode($this->input->post('short_content'), ENT_QUOTES, "UTF-8");
        $data['full_content'] = html_entity_decode($this->input->post('full_content'), ENT_QUOTES, "UTF-8");

		$isOK = $this->article_model->update_article($this->input->post('id'), $data);
		if($isOK){
			$this->session->set_flashdata('message', 'Information is saved');
	    	redirect('/article');
		} else {
			$this->session->set_flashdata('message', 'Can\'t save information');
	    	redirect('/article');
		}
	}
    
    function search(){
		$keyword = $this->input->get('keyword');
        
        $config['base_url'] = base_url().index_page().'/article/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] =$this->article_model->count_search_all($keyword);
		$this->pagination->initialize($config);
		
		$data['articles'] = $this->article_model->load_search_article($config['per_page'], $this->uri->segment(3), $keyword);
		$data['all_link']=$this->pagination->create_links();
		
        $data['title'] = "Article List";
	    $data['content'] = 'article/article_list';
		$this->load->view('template',$data,'');
	}
}
?>