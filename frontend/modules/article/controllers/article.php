<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Article extends MX_Controller { 
    public function __construct() {
        parent::__construct();
        $this->load->model('article/article_model');
    } 
    public function index(){
        $result = $this->article_model->get_articles();
        $data['num'] = $result->num_rows(); 
        $data['articles'] = $result->result();
        $this->load->view('articles', $data);
    }
    
    public function del(){
        $result = $this->article_model->get_del_article();
        $data['article'] = $result->row();
        $this->load->view('del', $data);
    }
    
    public function faq(){
        $result = $this->article_model->get_faqs();
        $data['faqs'] = $result->result();
        $this->load->view('faqs', $data);
    }
}