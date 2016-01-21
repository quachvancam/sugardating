<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Order_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function loadAllOrder($num=NULL, $offset=NULL){
		$this->db->limit($num, $offset);
		$this->db->select('order.*, user.name');
		$this->db->from('order');
        $this->db->join('user', 'user.id = order.user_id');
        $this->db->order_by('id','desc');
		$result = $this->db->get();	
		return $result->result();
	}
    function loadAllOrderName($kw=NULL){
		$this->db->select('order.*, user.name');
		$this->db->from('order');
        $this->db->join('user', 'user.id = order.user_id');
        $this->db->like('user.name', $kw);
        $this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result();
	}
	function countAllOrder(){
        $this->db->from('order');
        $this->db->join('user', 'user.id = order.user_id');
		$result = $this->db->count_all_results();
		return $result;
	}
    function loadOrder($ID=NULL){
        $this->db->select('order.*, user.name, user.email, user.code, user.city');
		$this->db->from('order');
        $this->db->join('user', 'user.id = order.user_id');
        $this->db->where('order.id', $ID);
		$result = $this->db->get();
		return $result->row();
	}
    function loadOrderItem($ID=NULL){
        $this->db->select('order_item.*, deal.name, deal.description, deal.old_price, deal.new_price, deal.image1, deal.time, deal_category.red_icon');
		$this->db->from('order_item');
        $this->db->join('deal', 'deal.id = order_item.deal_id');
        $this->db->join('deal_category', 'deal_category.id = order_item.category_id');
        $this->db->where('order_item.order_id', $ID);
		$result = $this->db->get();
		return $result->result();
	}
	function deleteOrder($ID=NULL){
		$arr = array('id' => $ID); 
		$result = $this->db->delete('order', $arr);
		return $result;
	}
    function deleteOrderItem($ID=NULL){
		$arr = array('order_id' => $ID); 
		$result = $this->db->delete('order_item', $arr);
		return $result;
	}
	
    
    function loadSearchOrder($num, $offset, $kw){
		
	}
    
    function countSearch($kw){
        $this->db->like('orderID', $kw);
		$result = $this->db->count_all('order');
		return $result;
	}
}