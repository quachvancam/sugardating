<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once APPPATH.'libraries/facebook/facebook.php';
class Cookie extends MX_Controller { 
    public function __construct() {
        parent::__construct(); 
    } 
    public function index(){
        $this->load->model('cookie/cookie_model');
        $data['cookie'] = $this->cookie_model->get_articles(21);
        $this->load->view('index', $data);
    }
}