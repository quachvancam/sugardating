<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Wishlist_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function loadAllWishlist($num=NULL, $offset=NULL,$userID=NULL){
		$this->db->limit($num, $offset);
		$this->db->select('wish_list.*, user.name, deal.name AS deal');
		$this->db->from('wish_list');
        $this->db->join('user', 'user.id = wish_list.user_id');
        $this->db->join('deal', 'deal.id = wish_list.deal_id');
        $this->db->where('wish_list.user_id', $userID);
        $this->db->order_by('id','desc');
		$result = $this->db->get();	
		return $result->result();
	}
    function loadAllWishlistName($kw=NULL,$userID=NULL){
        $this->db->select('wish_list.*, user.name, deal.name AS deal');
		$this->db->from('wish_list');
        $this->db->join('user', 'user.id = wish_list.user_id');
        $this->db->join('deal', 'deal.id = wish_list.deal_id');
        $this->db->where('wish_list.user_id', $userID);
        $this->db->like('deal.name', $kw);
        $this->db->order_by('id','desc');
		$result = $this->db->get();	
		return $result->result();
    }
	function countAllWishlist($userID=NULL){
        $this->db->where('user_id', $userID);
        $this->db->from('wish_list');
		$result = $this->db->count_all_results();
		return $result;
	}
    
	function deleteWishlist($ID=NULL){
		$arr = array('id' => $ID); 
		$result = $this->db->delete('wish_list', $arr);
		return $result;
	}
    
}