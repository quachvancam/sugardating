<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Home extends MX_Controller { 
    public function __construct() {
        parent::__construct();
    } 
    public function get_data(){
        $this->load->model('home/home_model');
        $result = $this->home_model->get_users();
        $data['users_num'] = $result->num_rows();
        $data['users'] = $result->result();
        
        $result1 = $this->home_model->get_blogs();
        $data['blogs_num'] = $result1->num_rows(); 
        $data['blogs'] = $result1->result();
        
        $this->load->view('home', $data);
    }
}