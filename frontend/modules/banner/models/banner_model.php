<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Banner_Model extends CI_Model 
{
    function __construct(){
        parent::__construct();
    }
    
    function load_banners(){
		$this->db->select('*');
		$this->db->from('banner');
        $this->db->where('publish', 1);
        $this->db->order_by('ordering');
		$result = $this->db->get();	
		return $result->result();
    }
}