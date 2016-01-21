<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class B2b_user extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('b2b_user_model');
    }
	function index()
	{
		$config['base_url'] = base_url().index_page().'/b2b_user/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		$config['total_rows'] =$this->b2b_user_model->get_all();
		$this->pagination->initialize($config);
		$data['users'] = $this->b2b_user_model->load_all_b2b($config['per_page'], $this->uri->segment(3));
		$data['all_link']=$this->pagination->create_links();			
        $data['title'] = "B2B List";
	    $data['content'] = 'user/b2b_list';
		$this->load->view('template',$data,'');
	}
	function edit($id = NULL){
		$data['user'] = $this->b2b_user_model->load_b2b($id);
		$data['title'] = "Edit B2B";
		$data['content'] = 'user/b2b_edit';
		$this->load->view('template',$data,'');
	}
	function add(){
		$data['title'] = "Add B2B";
		$data['content'] = 'user/b2b_add';
		$this->load->view('template',$data,'');
	}
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect(base_url().index_page().'b2b_user');
	}
	function save_edit(){
		$data['id'] = $this->input->post('id');
		$data['email'] = $this->input->post('email');
		$data['name'] = $this->input->post('name');
        $data['web'] = $this->input->post('web');
		$data['company'] = $this->input->post('company');
		$data['new_pass'] = $this->input->post('new_pass');
        
		$isOK = $this->b2b_user_model->update_b2b($data);
		if($isOK){
			$this->session->set_flashdata('message', 'New information is saved');
	    	redirect(base_url().index_page().'b2b_user');
		} else {
			$this->session->set_flashdata('message', 'Can\'t save new information');
	    	redirect(base_url().index_page().'b2b_user');
		}
	}
	
	function save_add(){
		$data['email'] = $this->input->post('email');
		$data['name'] = $this->input->post('name');
        $data['web'] = $this->input->post('web');
		$data['company'] = $this->input->post('company');
		$pass = $this->input->post('pass');
		$isOK = $this->b2b_user_model->check_b2b($data['email']);
		if($isOK){
			$this->session->set_flashdata('message', 'This email is used, please input other email');
	    	redirect(base_url().index_page().'b2b_user/add');
		}
        $data['password'] = md5($pass);
        $data['time'] = time();
        $data['publish']= 1;
        if($_FILES['image']['name']){
            $config['upload_path'] = get_config_value('upload_b2b_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= get_config_value('max_size');
			$config['encrypt_name']	= TRUE;    // rename to random string
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('image')){
				$datax = $this->upload->data();
				$data['image'] = $datax['file_name'];
			} else {
				$data['image'] = "";
			}
		}
        
		$isOK = $this->b2b_user_model->add_b2b($data);
		if($isOK){
            //Send mail to user B2B
            $data['link'] = base_url().index_page();
            $data['pass'] = $pass;
            $data['login'] = base_url().index_page().'user/login.html';
            $data['site'] = base_url().index_page().'index.html';
            $emailTo = array($data['email']);
            $mailOK = $this->b2b_user_model->sendEmail($emailTo, "Sugardating.dk - Detaljer for ny bruger", 'signupb2b', array('data' => $data), '');

			$this->session->set_flashdata('message', 'A B2B account is added');
	    	redirect(base_url().index_page().'b2b_user');
		} else {
			$this->session->set_flashdata('message', 'Can\'t add account');
	    	redirect(base_url().index_page().'b2b_user');
		}
	}
	
	function delete(){
		$ids = $this->input->post('id');
		foreach($ids as $id){
			$isOK = $this->b2b_user_model->delete_b2b($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect(base_url().index_page().'b2b_user');
			}
		}
		$this->session->set_flashdata('message', 'Selected account is deleted');
	    redirect(base_url().index_page().'b2b_user');
	}
	
	function search(){
		$keyword = $this->input->get('keyword');
        $config['base_url'] = base_url().index_page().'/b2b_user/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		$config['total_rows'] =$this->b2b_user_model->get_search_all($keyword);
		$this->pagination->initialize($config);
		$data['users'] = $this->b2b_user_model->load_search_b2b($config['per_page'], $this->uri->segment(3), $keyword);
		$data['all_link']=$this->pagination->create_links();			
        $data['title'] = "B2B List";
	    $data['content'] = 'user/b2b_list';
		$this->load->view('template',$data,'');
	}
	
	function publish(){
		$table = $this->input->post('table');
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		
		$isOK = $this->b2b_user_model->update_status($table, $id, $status);
		if($isOK){
			echo 1;
			exit;
		} else {
			echo 0;
			exit;
		}
	}
}
?>