<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Mbox extends MX_Controller { 
    public function __construct() {
        parent::__construct();
        $this->load->model('mbox/mbox_model');
    } 
    public function index($user_id){ 
        $data['sugars'] = $this->mbox_model->load_sugars($user_id); 
        $data['sweets'] = $this->mbox_model->load_sweets($user_id);
        $this->load->view('mbox', $data);
    }
}