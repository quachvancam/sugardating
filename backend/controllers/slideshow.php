<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Slideshow extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('slideshow_model');
    }

	function index()
	{
		$config['base_url'] = base_url().index_page().'/slideshow/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] =$this->slideshow_model->get_all();
		$this->pagination->initialize($config);
		
		$data['slideshows'] = $this->slideshow_model->load_all_slideshow($config['per_page'], $this->uri->segment(3));
		$data['all_link'] = $this->pagination->create_links();

        $data['title'] = 'Image List';
	    $data['content'] = 'slideshow/slideshow_list';
		$this->load->view('template',$data,'');
	}
	
	function add(){
		$data['title'] = "Add Banner";
		$data['content'] = 'slideshow/slideshow_add';
		$this->load->view('template',$data,'');
	}
	
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect('/slideshow');
	}
    
    function edit($id = NULL){
		$data['slideshow'] = $this->slideshow_model->load_slideshow($id);
		$data['title'] = "Edit Banner";
		
		$data['content'] = 'slideshow/slideshow_edit';
		$this->load->view('template',$data,'');
	}
    
    function save_add(){
		$data['title'] = $this->input->post('title');
		
		$isOK = $this->slideshow_model->add_slideshow($data);
		if($isOK){
			$this->session->set_flashdata('message', 'A image is added');
	    	redirect('/slideshow');
		} else {
			$this->session->set_flashdata('message', 'Can\'t add image');
	    	redirect('/slideshow');
		}
	}
    
    function save_edit(){
		$isOK = $this->slideshow_model->update_slideshow($this->input->post('id'));
		if($isOK){
			$this->session->set_flashdata('message', 'New information is saved');
	    	redirect('/slideshow');
		} else {
			$this->session->set_flashdata('message', 'Can\'t save new information');
	    	redirect('/slideshow');
		}
	}
    
    function delete(){
		$ids = $this->input->post('id');
		foreach($ids as $id){
			$isOK = $this->slideshow_model->delete_image($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect('/slideshow');
			}
		}
		$this->session->set_flashdata('message', 'Selected image is deleted');
	    redirect('/slideshow');
	}
}
?>