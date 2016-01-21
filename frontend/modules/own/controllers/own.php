<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Own extends MX_Controller { 
    public function __construct() {
        parent::__construct(); 
    } 
    public function left_content(){
        $this->load->model('own/own_model');
        $data['user'] = getUser();
        $data['num'] = $this->own_model->get_message_num(getUser()->id);
        $data['request_num'] = $this->own_model->get_request_num(getUser()->id);
        $data['photo_quantity'] = $this->own_model->get_photo_quantity();
        //Show user view my profile
        $data['view_quantity'] = $this->own_model->get_view_quantity(getUser()->id);
        $data['views'] = $this->own_model->get_views(getUser()->id);
        
        $data['anmodning'] = $this->own_model->get_anmodning(getUser()->id);
        $data['vip'] = $this->own_model->get_vip(getUser()->id);
        $this->load->view('own_left_content', $data);
    }
}