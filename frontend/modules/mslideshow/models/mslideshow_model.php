<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Mslideshow_Model extends CI_Model 
{
    function __construct(){
        parent::__construct();
    }
    
    function load_slideshows(){
		$this->db->select('*');
		$this->db->from('slideshow');
        $this->db->where('publish', 1);
        $this->db->order_by('ordering');
		$result = $this->db->get();	
		return $result->result();
    }
}