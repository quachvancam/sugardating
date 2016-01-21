<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');
    }

	function index()
	{
		$config['base_url'] = base_url().index_page().'/user/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] =$this->user_model->get_all();
		$this->pagination->initialize($config);
		
		$data['users'] = $this->user_model->load_all_user($config['per_page'], $this->uri->segment(3));
		$data['all_link']=$this->pagination->create_links();
						
        $data['title'] = "User List";
	    $data['content'] = 'user/list';
		$this->load->view('template',$data,'');
	}

	function edit($id = NULL){
		$data['user'] = $this->user_model->load_user($id);
		$data['title'] = "Edit User";
		
		$data['content'] = 'user/edit';
		$this->load->view('template',$data,'');
	}
	
	function add(){
		$data['title'] = "Add User";
		
		$data['content'] = 'user/add';
		$this->load->view('template',$data,'');
	}
	
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect(base_url().index_page().'user/');
	}
	
	function save_edit(){
		$isOK = $this->user_model->update_user();
		
		if($isOK){
			$this->session->set_flashdata('message', 'New information is saved');
	    	redirect(base_url().index_page().'user');
		} else {
			$this->session->set_flashdata('message', 'Can\'t save new information');
	    	redirect(base_url().index_page().'user');
		}
	}
	
	function save_add(){
		$isOK = $this->user_model->check_user($this->input->post('email'));
		if($isOK){
			$this->session->set_flashdata('message', 'This email is used, please input other email');
	    	redirect(base_url().index_page().'user/add');
		}
	
		$isOK = $this->user_model->add_user();
		
		if($isOK){
			$this->session->set_flashdata('message', 'A user account is added');
	    	redirect(base_url().index_page().'user');
		} else {
			$this->session->set_flashdata('message', 'Can\'t add account');
	    	redirect(base_url().index_page().'user');
		}
	}
	
	function delete(){
		$ids = $this->input->post('id');
		foreach($ids as $id){
			$isOK = $this->user_model->delete_user($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect(base_url().index_page().'user');
			}
		}
		$this->session->set_flashdata('message', 'Selected user is deleted');
	    redirect(base_url().index_page().'user');
	}
	
	function search(){
		$keyword = $this->input->get('keyword');
        
        $config['base_url'] = base_url().index_page().'/user/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] =$this->user_model->get_search_all($keyword);
		$this->pagination->initialize($config);
		
		$data['users'] = $this->user_model->load_search_user($config['per_page'], $this->uri->segment(3), $keyword);
		$data['all_link']=$this->pagination->create_links();
						
        $data['title'] = "User List";
	    $data['content'] = 'user/list';
		$this->load->view('template',$data,'');
	}
	
    function delete_avatar($user_id){
        $this->user_model->delete_avatar($user_id);
        redirect(base_url().index_page().'user/edit/'.$user_id);
    }
}
?>