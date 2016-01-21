<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Profile extends MX_Controller { 
    public function __construct() {
        parent::__construct(); 
    } 
    public function left_content($id){
        $this->load->model('profile/profile_model');
        $data['user'] = $this->profile_model->get_user_from_id($id);
        $this->load->view('profile_left_content', $data);
    }
}