<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class B2b_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function loadAllDeal($num=NULL, $offset=NULL, $name=NULL){
        $this->db->limit($num, $offset);
		$this->db->select('deal.*, deal_category.red_icon, b2b_user.company');
		$this->db->from('deal');
        $this->db->join('deal_category', 'deal.category_id = deal_category.id');
        $this->db->join('b2b_user', 'deal.b2b_id = b2b_user.id');
        if($name){
            $this->db->like('deal.name', $name);
        }
		$result = $this->db->get();	
		return $result->result();
	}
    function loadAllDealName($name=NULL){
		$this->db->select('deal.*, deal_category.red_icon, b2b_user.company');
		$this->db->from('deal');
        $this->db->join('deal_category', 'deal.category_id = deal_category.id');
        $this->db->join('b2b_user', 'deal.b2b_id = b2b_user.id');
        if($name){
            $this->db->like('deal.name', $name);
        }
		$result = $this->db->get();
		return $result->result();
	}
    function countAllDeal(){
		$result = $this->db->count_all('deal');
		return $result;
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
        $result = $this->db->get();
		return $result->result();
    }
    function deleteDeal($ID=NULL){
		$arr = array('id' => $ID); 
		$result = $this->db->delete('deal', $arr);
		return $result;
	}
    function updateDeal($ID=NULL){
        $this->db->set('status', 1);
        $this->db->where('id', $ID);
		$result = $this->db->update('order_item');
		return $result;
    }
}