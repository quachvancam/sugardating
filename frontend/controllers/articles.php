<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('articles_model');
    }

    function view($id){
        $article = $this->articles_model->load_article($id);
        $data['article'] = $article;
		$data['title'] = $article->title;
		$data['content']='articles/detail';
		$this->load->view('templates',$data,'');
    }
}
?>