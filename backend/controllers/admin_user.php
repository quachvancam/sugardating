<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_user extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('admin_user_model');
    }

	function index()
	{
		$data['users'] = $this->admin_user_model->load_all_admin();
        $data['title'] = "Administrator List";
	    $data['content'] = 'user/admin_list';
		$this->load->view('template',$data,'');
	}

	function edit($id = NULL){
		$data['user'] = $this->admin_user_model->load_admin($id);
		$data['title'] = "Edit Administrator";
		
		$data['content'] = 'user/admin_edit';
		$this->load->view('template',$data,'');
	}
	
	function add(){
		$data['title'] = "Add Administrator";
		
		$data['content'] = 'user/admin_add';
		$this->load->view('template',$data,'');
	}
	
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect('/admin_user');
	}
	
	function save_edit(){
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$new_pass = $this->input->post('new_pass');
		$isOK = $this->admin_user_model->update_admin($id, $name, $new_pass);
		if($isOK){
			$this->session->set_flashdata('message', 'New information is saved');
	    	redirect('/admin_user');
		} else {
			$this->session->set_flashdata('message', 'Can\'t save new information');
	    	redirect('/admin_user');
		}
	}
	
	function save_add(){
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$pass = $this->input->post('pass');
		
		$isOK = $this->admin_user_model->check_admin($email);
		if($isOK){
			$this->session->set_flashdata('message', 'This email is used, please input other email');
	    	redirect('/admin_user/add');
		}
		$isOK = $this->admin_user_model->add_admin($name, $email, $pass);
		if($isOK){
			$this->session->set_flashdata('message', 'A admin account is added');
	    	redirect('/admin_user');
		} else {
			$this->session->set_flashdata('message', 'Can\'t add account');
	    	redirect('/admin_user');
		}
	}
	
	function delete(){
		$ids = $this->input->post('adminid');
		foreach($ids as $id){
			$isOK = $this->admin_user_model->delete_admin($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect('/admin_user');
			}
		}
		$this->session->set_flashdata('message', 'Selected account is deleted');
	    redirect('/admin_user');
	}
}
?>