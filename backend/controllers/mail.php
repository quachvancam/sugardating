<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('mail_model');
    }

	function index()
	{
        $data['mails'] = $this->mail_model->load_all_mail();
        $data['title'] = "Mail List";
	    $data['content'] = 'mail/mail_list';
		$this->load->view('template',$data,'');
	}
	
	function add(){
		$data['title'] = "Add Config";
		
		$data['content'] = 'mail/mail_add';
		$this->load->view('template',$data,'');
	}
	
	function edit($id = NULL){
		$data['mail'] = $this->mail_model->load_mail($id);
		$data['title'] = "Edit Mail";
		
		$data['content'] = 'mail/mail_edit';
		$this->load->view('template',$data,'');
	}
	
	function delete(){
		$ids = $this->input->post('id');
		foreach($ids as $id){
			$isOK = $this->mail_model->delete_mail($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect('/mail');
			}
		}
		$this->session->set_flashdata('message', 'Selected mail template is deleted');
	    redirect('/mail');
	}

	function save_add(){
		$data['title'] = $this->input->post('title');
		$data['content'] = $_POST['content'];
		
		$isOK = $this->mail_model->add_mail($data);
		if($isOK){
			$this->session->set_flashdata('message', 'A mail template is added');
	    	redirect('/mail');
		} else {
			$this->session->set_flashdata('message', 'Can\'t add mail template');
	    	redirect('/mail');
		}
	}
	
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect('/mail');
	}
	
	function save_edit(){
		$data['id'] = $this->input->post('id');
		$data['title'] = $this->input->post('title');
		$data['content'] = $_POST['content'];

		$isOK = $this->mail_model->update_mail($data);
		if($isOK){
			$this->session->set_flashdata('message', 'New information is saved');
	    	redirect('/mail');
		} else {
			$this->session->set_flashdata('message', 'Can\'t save new information');
	    	redirect('/mail');
		}
	}
}
?>