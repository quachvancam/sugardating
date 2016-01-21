<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Deal extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('deal_model');
    }

	function index()
	{
		$config['base_url'] = base_url().index_page().'/deal/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] =$this->deal_model->count_all();
		$this->pagination->initialize($config);
		
		$data['deals'] = $this->deal_model->load_all_deal($config['per_page'], $this->uri->segment(3));
		$data['all_link']=$this->pagination->create_links();
		
        $data['title'] = "Deal List";
	    $data['content'] = 'deal/deal_list';
		$this->load->view('template',$data,'');
	}
	
	function add(){
		$data['title'] = "Add Deal";
		$data['b2bs'] = $this->deal_model->load_b2b();
        $data['categories'] = $this->deal_model->load_categories();
		$data['content'] = 'deal/deal_add';
		$this->load->view('template',$data,'');
	}
	
	function edit($id = NULL){
		$data['deal'] = $this->deal_model->load_deal($id);
		$data['b2bs'] = $this->deal_model->load_b2b();
        $data['categories'] = $this->deal_model->load_categories();
		$data['title'] = "Edit Deal";
		
		$data['content'] = 'deal/deal_edit';
		$this->load->view('template',$data,'');
	}
	
	function delete(){
		$ids = $this->input->post('id');
		foreach($ids as $id){
			$isOK = $this->deal_model->delete_deal($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect(base_url().index_page().'deal.html');
			}
		}
		$this->session->set_flashdata('message', 'Selected deal is deleted');
	    redirect(base_url().index_page().'deal.html');
	}
    function deleteimage($image, $id){
        $isOK = $this->deal_model->delete_image($image, $id);
        redirect(base_url().index_page().'deal/edit/'.$id.'.html');
    }
    
	function save_add(){
		$isOK = $this->deal_model->add_deal();
		if($isOK){
			$this->session->set_flashdata('message', 'A deal is added');
	    	redirect(base_url().index_page().'deal.html');
		} else {
			$this->session->set_flashdata('message', 'Can\'t add deal');
	    	redirect(base_url().index_page().'deal.html');
		}
	}
	
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect(base_url().index_page().'deal.html');
	}
	
	function save_edit(){
		$isOK = $this->deal_model->update_deal();
		if($isOK){
			$this->session->set_flashdata('message', 'New information is saved');
	    	redirect(base_url().index_page().'deal.html');
		} else {
			$this->session->set_flashdata('message', 'Can\'t save new information');
	    	redirect(base_url().index_page().'deal.html');
		}
	}
    
    function search(){
        $keyword = $this->input->get('keyword');
		$config['base_url'] = base_url().index_page().'/deal/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] =$this->deal_model->count_search_all($keyword);
		$this->pagination->initialize($config);
		
		$data['deals'] = $this->deal_model->load_search_deal($config['per_page'], $this->uri->segment(3), $keyword);
		$data['all_link']=$this->pagination->create_links();
		
        $data['title'] = "Deal List";
	    $data['content'] = 'deal/deal_list';
		$this->load->view('template',$data,'');
	}
}
?>