<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Article_Model extends MX_Controller { 
    public function __construct() {
        parent::__construct(); 
    }
     
    function get_articles(){
        $this->db->select('id, title, alias, short_content, time');
        $this->db->from('article');
        $this->db->where('publish', 1);
        $this->db->where('category_id', 5);
        $this->db->order_by('time DESC');
        $this->db->limit(3, 0);
        $result = $this->db->get();
        return $result;
    }
    
    function get_del_article(){
        $this->db->select('title, short_content');
        $this->db->from('article');
        $this->db->where('id', 14);
        $result = $this->db->get();
        return $result;
    }
    
    function get_faqs(){
        $this->db->select('id, title, alias');
        $this->db->where('publish', 1);
        $this->db->where('category_id', 2);
        $this->db->order_by('time DESC');
        $result = $this->db->get('article', 5, 0);
        return $result;
    }
}