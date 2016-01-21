<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('gallery_model');
    }

	function index()
	{
		$user_id = $this->uri->segment(3);
		$name = $this->gallery_model->load_user_name($user_id);
		$data['title'] = $name."'s Gallery";
		
		$config['base_url'] = base_url().index_page().'/gallery/index/'.$user_id.'/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 4;
		$config['total_rows'] = $this->gallery_model->get_all($user_id);
        
		$this->pagination->initialize($config);
		
		$data['images'] = $this->gallery_model->load_all_image($user_id, $config['per_page'], $this->uri->segment(4));
		$data['all_link']=$this->pagination->create_links();

	    $data['content'] = 'gallery/list';
		$this->load->view('template',$data,'');
	}
	
	function add(){
		$data['title'] = "Add Image";
		$data['content'] = 'gallery/add';
		$this->load->view('template',$data,'');
	}
	
	function delete(){
		$ids = $this->input->post('id');
		$user_id =  $this->input->post('user_id');
		foreach($ids as $id){
			$isOK = $this->gallery_model->delete_image($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect('/gallery/index/'.$user_id);
			}
		}
		$this->session->set_flashdata('message', 'Selected image is deleted');
	    redirect('/gallery/index/'.$user_id);
	}

	function save_add(){		
		$isOK = $this->gallery_model->add_image($files);
		if($isOK){
			$this->session->set_flashdata('message', 'A config is added');
	    	redirect('/gallery/index/'.$this->uri->segment(3));
		} else {
			$this->session->set_flashdata('message', 'Can\'t add config');
	    	redirect('/gallery/index/'.$this->uri->segment(3));
		}
	}
	
	function ajax_save(){
		$user_id = $this->uri->segment(3);
		$isOK = $this->gallery_model->add_image($user_id);
		if($isOK){
			echo '{"status":"success"}';
			exit;
		} else {
			echo '{"status":"error"}';
			exit;
		}
	}
	
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect('/gallery/index/'.$this->uri->segment(3));
	}
}
?>