<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('banner_model');
    }

	function index()
	{
		$config['base_url'] = base_url().index_page().'/banner/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] =$this->banner_model->get_all();
		$this->pagination->initialize($config);
		
		$data['banners'] = $this->banner_model->load_all_banner($config['per_page'], $this->uri->segment(3));
		$data['all_link'] = $this->pagination->create_links();

        $data['title'] = 'Banner List';
	    $data['content'] = 'banner/banner_list';
		$this->load->view('template',$data,'');
	}
	
	function add(){
		$data['title'] = "Add Banner";
		$data['content'] = 'banner/banner_add';
		$this->load->view('template',$data,'');
	}
	
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect('/banner');
	}
    
    function edit($id = NULL){
		$data['banner'] = $this->banner_model->load_banner($id);
		$data['title'] = "Edit Banner";
		
		$data['content'] = 'banner/banner_edit';
		$this->load->view('template',$data,'');
	}
    
    function save_add(){
		$data['title'] = $this->input->post('title');
		
		$isOK = $this->banner_model->add_banner($data);
		if($isOK){
			$this->session->set_flashdata('message', 'A banner is added');
	    	redirect('/banner');
		} else {
			$this->session->set_flashdata('message', 'Can\'t add banner');
	    	redirect('/banner');
		}
	}
    
    function save_edit(){
		$isOK = $this->banner_model->update_banner($this->input->post('id'));
		if($isOK){
			$this->session->set_flashdata('message', 'New information is saved');
	    	redirect('/banner');
		} else {
			$this->session->set_flashdata('message', 'Can\'t save new information');
	    	redirect('/banner');
		}
	}
    
    function delete(){
		$ids = $this->input->post('id');
		foreach($ids as $id){
			$isOK = $this->banner_model->delete_banner($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect('/banner');
			}
		}
		$this->session->set_flashdata('message', 'Selected banner is deleted');
	    redirect('/banner');
	}
}
?>