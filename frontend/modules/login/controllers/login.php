<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Login extends MX_Controller { 
    public function __construct() {
        parent::__construct(); 
    } 
    public function index(){ 
        if(!isLogged()){
            $this->load->view('login');
        } else {
            $this->load->model('login/login_model');
            $data['user'] = getUser();
            $data['num'] = $this->login_model->get_message_num(getUser()->id);
            $this->load->view('profile', $data);
        }
    }
    
    public function header_site(){ 
        if(!isLogged()){
            $this->load->view('header_login');
        } else {
            if ($this->session->userdata('b2b') == TRUE) {
                $data['B2B'] = true;
            }
            else{
                $data['B2B'] = false;
            }
            $data['user'] = getUser();
            $this->load->view('header_profile', $data);
        }
    } 
}