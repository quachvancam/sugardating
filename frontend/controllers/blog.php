<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('blog_model');
    }

    function bloglist(){
        $user_id = $this->uri->segment(3);
		$name = $this->blog_model->load_user_name($user_id);
		$data['title'] = $name."'s Blog";
		
		$config['base_url'] = base_url().index_page().'/blog/blog_list/'.$user_id.'/'.$name.'/';
		$config['per_page'] = 5;
		$config['uri_segment'] = 5; 
		
		$config['total_rows'] =$this->blog_model->get_all($user_id);
		$this->pagination->initialize($config);
		
		$data['blogs'] = $this->blog_model->load_all_blog($user_id, $config['per_page'], $this->uri->segment(5));
		$data['all_link']=$this->pagination->create_links();
        
        $user = new stdClass;
        $user->id = $user_id;
        $data['user'] = $user;
        
		$data['content']='blog/list';
		$this->load->view('templates',$data,'');
    }
    
    function detail($id){
        $data['blog'] = $this->blog_model->load_blog($id);
		$data['title'] = $data['blog']->title;
        
        $user = new stdClass;
        $user->id = $data['blog']->user_id;
        $data['user'] = $user;
		
		$data['content'] = 'blog/detail';
		$this->load->view('templates', $data,'');
    }
}
?>