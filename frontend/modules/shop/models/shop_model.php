<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Shop_Model extends CI_Model 
{
    function __construct(){
        parent::__construct();
    }
    function loadDealLimit($num=NULL){
		$this->db->limit($num);
		$this->db->select('deal.*, b2b.company AS company_name');
		$this->db->from('deal');
        $this->db->join('b2b_user as b2b', 'deal.b2b_id = b2b.id');
        $this->db->where('end_date >', time());
        $this->db->order_by('id', 'asc');
		$result = $this->db->get();	
		return $result->result();
	}
}