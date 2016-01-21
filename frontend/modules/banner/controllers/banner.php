<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Banner extends MX_Controller { 
    public function __construct() {
        parent::__construct();
        $this->load->model('banner/banner_model');
    } 
    public function index(){ 
        $data['banners'] = $this->banner_model->load_banners(); 
        $this->load->view('banner', $data);
    }
}