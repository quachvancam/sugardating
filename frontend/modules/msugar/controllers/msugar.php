<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Msugar extends MX_Controller { 
    public function __construct() {
        parent::__construct();
        $this->load->model('msugar/msugar_model');
    } 
    public function index($id, $content, $function){
        $data['id'] = $id;
        $data['content'] = $content;
        $data['function'] = $function;
        $this->load->view('msugar', $data);
    }
}