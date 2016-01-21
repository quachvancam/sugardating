<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Deal_Category extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('deal_category_model');
    }

	function index()
	{
		$config['base_url'] = base_url().index_page().'/deal_category/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] =$this->deal_category_model->get_all();
		$this->pagination->initialize($config);
		
		$data['deal_categories'] = $this->deal_category_model->load_all_deal_category($config['per_page'], $this->uri->segment(3));
		$data['all_link']=$this->pagination->create_links();

        $data['title'] = 'Deal Category';
	    $data['content'] = 'deal_category/deal_category_list';
		$this->load->view('template',$data,'');
	}
	
	function add(){
		$data['title'] = "Add Deal Category";
		$data['content'] = 'deal_category/deal_category_add';
		$this->load->view('template',$data,'');
	}
	
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect('/deal_category');
	}
    
    function edit($id = NULL){
		$data['deal_category'] = $this->deal_category_model->load_deal_category($id);
		$data['title'] = "Edit Deal Category";
		
		$data['content'] = 'deal_category/deal_category_edit';
		$this->load->view('template',$data,'');
	}
    
    function save_add(){
		$data['name'] = $this->input->post('name');
		
		$isOK = $this->deal_category_model->add_deal_category($data);
		if($isOK){
			$this->session->set_flashdata('message', 'A deal category is added');
	    	redirect('/deal_category');
		} else {
			$this->session->set_flashdata('message', 'Can\'t add deal category');
	    	redirect('/deal_category');
		}
	}
    
    function save_edit(){
		$isOK = $this->deal_category_model->update_deal_category($this->input->post('id'));
		if($isOK){
			$this->session->set_flashdata('message', 'New information is saved');
	    	redirect('/deal_category');
		} else {
			$this->session->set_flashdata('message', 'Can\'t save new information');
	    	redirect('/deal_category');
		}
	}
    
    function delete(){
		$ids = $this->input->post('id');
		foreach($ids as $id){
			$isOK = $this->deal_category_model->delete_deal_category($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect('/deal_category');
			}
		}
		$this->session->set_flashdata('message', 'Selected deal category is deleted');
	    redirect('/deal_category');
	}
}
?>