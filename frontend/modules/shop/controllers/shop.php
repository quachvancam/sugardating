<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Shop extends MX_Controller { 
    public function __construct() {
        parent::__construct();
        $this->load->model('shop/shop_model');
    } 
    public function index(){ 
        $data['deals'] = $this->shop_model->loadDealLimit(10);
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $user = "";
        }
        $data['user'] = $user;
        $this->load->view('index', $data);
    }
}