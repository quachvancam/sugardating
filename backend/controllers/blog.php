<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('blog_model');
    }

	function index()
	{
		$user_id = $this->uri->segment(3);
		$name = $this->blog_model->load_user_name($user_id);
		$data['title'] = $name."'s Blog";
		
		$config['base_url'] = base_url().index_page().'/blog/index/'.$user_id.'/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 4; 
		
		$config['total_rows'] =$this->blog_model->get_all($user_id);
		$this->pagination->initialize($config);
		
		$data['blogs'] = $this->blog_model->load_all_blog($user_id, $config['per_page'], $this->uri->segment(4));
		$data['all_link']=$this->pagination->create_links();

	    $data['content'] = 'blog/blog_list';
		$this->load->view('template',$data,'');
	}
	
	function add(){
        $data['user_id'] = $this->uri->segment(3);
		$data['title'] = "Add Blog";
		$data['content'] = 'blog/blog_add';
		$this->load->view('template',$data,'');
	}
	
	function edit($user_id, $id){
		$data['blog'] = $this->blog_model->load_blog($id);
        $data['user_id'] = $user_id;
		$data['title'] = "Edit Blog";
		
		$data['content'] = 'blog/blog_edit';
		$this->load->view('template', $data,'');
	}
	
	function delete(){
		$ids = $this->input->post('id');
		foreach($ids as $id){
			$isOK = $this->blog_model->delete_blog($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect('/blog/index/'.$this->input->post('user_id'));
			}
		}
		$this->session->set_flashdata('message', 'Selected blog is deleted');
	    redirect('/blog/index/'.$this->input->post('user_id'));
	}

	function save_add(){
		$data['title'] = $this->input->post('title');
		$data['content'] = $this->input->post('content');
        $data['user_id'] = $this->input->post('user_id');
		
		$isOK = $this->blog_model->add_blog($data);
		if($isOK){
			$this->session->set_flashdata('message', 'A blog is added');
	    	redirect('/blog/index/'.$this->input->post('user_id'));
		} else {
			$this->session->set_flashdata('message', 'Can\'t add blog');
	    	redirect('/blog/index/'.$this->input->post('user_id'));
		}
	}
	
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect('/blog/index/'.$this->uri->segment(3));
	}
	
	function save_edit(){
		$isOK = $this->blog_model->update_blog($this->input->post('id'));
		if($isOK){
			$this->session->set_flashdata('message', 'New information is saved');
	    	redirect('/blog/index/'.$this->input->post('user_id'));
		} else {
			$this->session->set_flashdata('message', 'Can\'t save new information');
	    	redirect('/blog/index/'.$this->input->post('user_id'));
		}
	}
}
?>