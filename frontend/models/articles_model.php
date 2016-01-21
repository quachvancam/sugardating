<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Articles_Model extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function load_article($id){
        $this->db->select('*');
		$this->db->where('id', $id);
		$result = $this->db->get('article');
		return $result->row();
	}

    /** The End*/
}