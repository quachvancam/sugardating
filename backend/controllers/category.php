<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('category_model');
    }

	function index()
	{
		$config['base_url'] = base_url().index_page().'/category/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] =$this->category_model->count_all();
		$this->pagination->initialize($config);
		
		$data['categories'] = $this->category_model->load_all_category($config['per_page'], $this->uri->segment(3));
		$data['all_link']=$this->pagination->create_links();
		
        $data['title'] = "Caterory List";
	    $data['content'] = 'article/category_list';
		$this->load->view('template',$data,'');
	}
	
	function add(){
		$data['title'] = "Add Category";
		
		$data['content'] = 'article/category_add';
		$this->load->view('template',$data,'');
	}
	
	function edit($id = NULL){
		$data['category'] = $this->category_model->load_category($id);
		$data['title'] = "Edit Category";
		
		$data['content'] = 'article/category_edit';
		$this->load->view('template',$data,'');
	}
	
	function delete(){
		$ids = $this->input->post('id');
		foreach($ids as $id){
			$isOK = $this->category_model->delete_category($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect('/category');
			}
		}
		$this->session->set_flashdata('message', 'Selected category is deleted');
	    redirect('/category');
	}

	function save_add(){
		$data['name'] = $this->input->post('name');
		
		$isOK = $this->category_model->add_category($data);
		if($isOK){
			$this->session->set_flashdata('message', 'A category is added');
	    	redirect('/category');
		} else {
			$this->session->set_flashdata('message', 'Can\'t add category');
	    	redirect('/category');
		}
	}
	
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect('/category');
	}
	
	function save_edit(){
		$data['id'] = $this->input->post('id');
		$data['name'] = $this->input->post('name');

		$isOK = $this->category_model->update_category($data);
		if($isOK){
			$this->session->set_flashdata('message', 'New information is saved');
	    	redirect('/category');
		} else {
			$this->session->set_flashdata('message', 'Can\'t save new information');
	    	redirect('/category');
		}
	}
}
?>