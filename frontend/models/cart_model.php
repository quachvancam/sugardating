<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Cart_Model extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function loadDeal($id){
		$this->db->where('id', $id);
		$result = $this->db->get('deal');
		return $result->row();
	}

    /** The End*/
}