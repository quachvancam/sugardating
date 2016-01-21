<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Mslideshow extends MX_Controller { 
    public function __construct() {
        parent::__construct();
        $this->load->model('mslideshow/mslideshow_model');
    } 
    public function index(){ 
        $data['slideshows'] = $this->mslideshow_model->load_slideshows(); 
        $this->load->view('mslideshow', $data);
    }
}