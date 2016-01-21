<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('config_model');
    }

	function index()
	{
        $data['configs'] = $this->config_model->load_all_config();
        $data['title'] = "Config List";
	    $data['content'] = 'config/config';
		$this->load->view('template',$data,'');
	}
	
	function add(){
		$data['title'] = "Add Config";
		
		$data['content'] = 'config/config_add';
		$this->load->view('template',$data,'');
	}
	
	function edit($id = NULL){
		$data['config'] = $this->config_model->load_config($id);
		$data['title'] = "Edit Config";
		
		$data['content'] = 'config/config_edit';
		$this->load->view('template',$data,'');
	}
	
	function delete(){
		$ids = $this->input->post('id');
		foreach($ids as $id){
			$isOK = $this->config_model->delete_config($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect('/config');
			}
		}
		$this->session->set_flashdata('message', 'Selected value is deleted');
	    redirect('/config');
	}

	function save_add(){
		$data['name'] = $this->input->post('name');
		$data['config'] = $this->input->post('config');
		$data['value'] = $this->input->post('value');
		
		$isOK = $this->config_model->check_config($data['config']);
		if($isOK){
			$this->session->set_flashdata('message', 'This config is used, please input other config');
	    	redirect('/config/add');
		}
		
		$isOK = $this->config_model->add_config($data);
		if($isOK){
			$this->session->set_flashdata('message', 'A config is added');
	    	redirect('/config');
		} else {
			$this->session->set_flashdata('message', 'Can\'t add config');
	    	redirect('/config');
		}
	}
	
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect('/config');
	}
	
	function save_edit(){
		$data['id'] = $this->input->post('id');
		$data['name'] = $this->input->post('name');
		$data['config'] = $this->input->post('config');
		$data['value'] = $this->input->post('value');

		$isOK = $this->config_model->update_config($data);
		if($isOK){
			$this->session->set_flashdata('message', 'New information is saved');
	    	redirect('/config');
		} else {
			$this->session->set_flashdata('message', 'Can\'t save new information');
	    	redirect('/config');
		}
	}
}
?>