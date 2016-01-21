<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class B2b_Model extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    function loadAllDeal($userID=NULL, $name=NULL){
		$this->db->select('deal.*, deal_category.red_icon');
		$this->db->from('deal');
        $this->db->join('deal_category', 'deal.category_id = deal_category.id');
        $this->db->where('deal.b2b_id', $userID);
        if($name){
            $this->db->like('deal.name', $name);
        }
		$result = $this->db->get();
		return $result->result();
	}
	function countSumDeal($ID=NULL){
		$this->db->select('SUM(quantity) AS quantity');
		$this->db->from('order_item');
        $this->db->where('deal_id', $ID);
		$result = $this->db->get();	
		return $result->row();
	}
	
    function loadDealItems($ID=NULL,$code=NULL){
        $this->db->select('order_item.*, order.orderID, deal_category.name, user.name AS customer');
		$this->db->from('order_item');
        $this->db->join('order', 'order.id = order_item.order_id');
        $this->db->join('deal_category', 'deal_category.id = order_item.category_id');
        $this->db->join('user', 'user.id = order.user_id');
        $this->db->where('order_item.deal_id', $ID);
        if($code){
            $this->db->where('order_item.codes', $code);
        }
        #$this->db->where('order.status', 1);
        $result = $this->db->get();
		return $result->result();
    }
    
    function updateDeal($ID=NULL){
        $this->db->set('status', 1);
        $this->db->where('id', $ID);
		$result = $this->db->update('order_item');
		return $result;
    }
    /** The End*/
}