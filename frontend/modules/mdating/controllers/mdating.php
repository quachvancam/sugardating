<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Mdating extends MX_Controller { 
    public function __construct() {
        parent::__construct();
    } 
    public function index(){ 
        $this->load->view('mdating');
    }
}