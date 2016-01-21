<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Mbox_Model extends CI_Model 
{
    function __construct(){
        parent::__construct();
    }
    
    function load_sugars($user_id){
		$this->db->select('deal.name, deal.image1, deal.id, deal.alias');
		$this->db->from('order_item');
        $this->db->join('deal', 'deal.id = order_item.deal_id');
        $this->db->join('order', 'order.id = order_item.order_id');
        $this->db->where('order.user_id', $user_id);
        $this->db->where('order.status', 1);
        $this->db->order_by('order_item.id', 'desc');
        $result = $this->db->get();
		return $result->result();
    }
    
    function load_sweets($user_id){
		$this->db->select('deal.name, deal.image1, deal.id, deal.alias');
		$this->db->from('deal');
        $this->db->join('wish_list', 'wish_list.deal_id = deal.id');
        $this->db->where('wish_list.user_id', $user_id);
        $result = $this->db->get();
		return $result->result();
    }
}