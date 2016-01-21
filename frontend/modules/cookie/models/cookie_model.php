<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Cookie_Model extends MX_Controller { 
    public function __construct() {
        parent::__construct(); 
    }
    function get_articles($id=NULL){
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('id', $id);
        $this->db->where('publish', 1);
        $result = $this->db->get();
        return $result->row();
    }
}