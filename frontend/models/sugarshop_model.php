<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Sugarshop_Model extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    /** Search Name*/
    function loadAllDealName($num=NULL, $offset=NULL, $name=NULL){
		$this->db->limit($num, $offset);
		$this->db->select('deal.*, b2b.company AS company_name');
		$this->db->from('deal');
        $this->db->join('b2b_user as b2b', 'deal.b2b_id = b2b.id');
        if($name){
            $this->db->like('deal.name', $name); 
        }
        $this->db->order_by('expiry, ordering');
		$result = $this->db->get();	
		return $result->result();
	}
    function countAllDealName($name=NULL){
        if($name){
            $this->db->like('name', $name); 
        }
        $this->db->from('deal');
		$result = $this->db->count_all_results();
		return $result;
	}
    /** End Search*/
    function loadAllDeal($num=NULL, $offset=NULL, $categoryID=NULL){
		$this->db->limit($num, $offset);
		$this->db->select('deal.*, b2b.company AS company_name');
		$this->db->from('deal');
        $this->db->join('b2b_user as b2b', 'deal.b2b_id = b2b.id');
        if($categoryID){
            $this->db->where('deal.category_id', $categoryID);
        }
        $this->db->where('end_date >', time());
        $this->db->order_by('expiry, ordering');
		$result = $this->db->get();	
		return $result->result();
	}
	function loadDealLimit($num=NULL){
		$this->db->limit($num);
		$this->db->select('deal.*, b2b.company AS company_name');
		$this->db->from('deal');
        $this->db->join('b2b_user as b2b', 'deal.b2b_id = b2b.id');
        $this->db->order_by('id', 'asc');
		$result = $this->db->get();	
		return $result->result();
	}
	function loadDeal($ID=NULL){
        $this->db->select('deal.*, b2b.company AS company_name, b2b.id AS company_code, b2b.image as company_image, b2b.web as company_web');
		$this->db->from('deal');
        $this->db->join('b2b_user as b2b', 'deal.b2b_id = b2b.id');
		$this->db->where('deal.id', $ID);
		$result = $this->db->get();
		return $result->row();
	}
    function updateDeal($ID=NULL,$data=NULL){
        $this->db->where('id', $ID);
        $this->db->update('deal', $data);
    }
	function countAllDeal($categoryID=NULL){
        if($categoryID){
            $this->db->where('category_id', $categoryID);
        }
        $this->db->where('end_date >', time());
        $this->db->from('deal');
		$result = $this->db->count_all_results();
		return $result;
	}
    function createOrder($order=NULL){
        $this->db->insert('order', $order);
        return $this->db->insert_id();
    }
    function updateOrder($order=NULL,$ID=NULL){
        $this->db->where('id', $ID);
        $this->db->update('order', $order);
    }
    function selectOrder($ID=NULL){
        $this->db->where('id', $ID);
        $result = $this->db->get('order');
		return $result->row();
    }
    function selectOrderItems($orderID=NULL){
        $this->db->select('order_item.*, deal.image1 AS image, deal.title, deal.description');
		$this->db->from('deal');
        $this->db->join('order_item', 'deal.id = order_item.deal_id');
        $this->db->where('order_item.order_id', $orderID);
        $result = $this->db->get();
		return $result->result();
    }
    function deleteOrder($ID=NULL){
        $this->db->where('id', $ID);
        $this->db->delete('order'); 
    }
    function addItems($data=NULL){
        $this->db->insert('order_item', $data);
    }
    function deleteItems($ID=NULL){
        $this->db->where('order_id', $ID);
        $this->db->delete('order_item');
    }
    function loadDealCategorys(){
        $this->db->from('deal_category');
        $this->db->order_by('ordering', 'asc');
		$result = $this->db->get();	
		return $result->result();
    }
    function loadDealByUser($userID=NULL){
        $this->db->select('order_item.id as itemid, order_item.codes, order_item.quantity, order_item.emailgift, order_item.status, deal.id, deal.name, deal.title, deal.description, deal.image1, deal_category.red_icon');
		$this->db->from('order_item');
        $this->db->join('deal', 'deal.id = order_item.deal_id');
        $this->db->join('deal_category', 'deal_category.id = deal.category_id');
        $this->db->join('order', 'order.id = order_item.order_id');
        $this->db->where('order.status', 1);
        $this->db->where('order.user_id', $userID);
        $this->db->order_by('order_item.id', 'desc');
        $result = $this->db->get();
		return $result->result();
    }
    function loadPurchaseByUser($userID=NULL){
        $this->db->select('order_item.id as itemid, order_item.codes, order_item.quantity, order_item.emailgift, order_item.status, deal.id, deal.name, deal.title, deal.description, deal.image1, deal_category.red_icon');
		$this->db->from('order_item');
        $this->db->join('deal', 'deal.id = order_item.deal_id');
        $this->db->join('deal_category', 'deal_category.id = deal.category_id');
        $this->db->join('order', 'order.id = order_item.order_id');
        $this->db->where('order.status', 1);
        //$this->db->where('order_item.status', 0);
        $this->db->where('order.user_id', $userID);
        $this->db->order_by('order_item.id', 'desc');
        $result = $this->db->get();
		return $result->result();
    }
    function loadGiftByUser($userID=NULL){
        $this->db->select('order_item.id as itemid, order_item.codes, order_item.quantity, order_item.emailgift, order_item.status, deal.id, deal.name, deal.title, deal.description, deal.image1, deal_category.red_icon');
		$this->db->from('order_item');
        $this->db->join('deal', 'deal.id = order_item.deal_id');
        $this->db->join('deal_category', 'deal_category.id = deal.category_id');
        $this->db->join('order', 'order.id = order_item.order_id');
        $this->db->where('order.status', 1);
        $this->db->where('order_item.emailgift <>', '');
        $this->db->where('order.user_id', $userID);
        $this->db->order_by('order_item.id', 'desc');
        $result = $this->db->get();
		return $result->result();
    }
    function loadDealItems($ID=NULL){
        $this->db->select('order_item.*, deal.image1 AS image, deal.title, deal.description, deal_category.red_icon');
		$this->db->from('deal');
        $this->db->join('order_item', 'deal.id = order_item.deal_id');
        $this->db->join('deal_category', 'deal_category.id = deal.category_id');
        
        $this->db->where('order_item.id', $ID);
        $result = $this->db->get();
		return $result->row();
    }
    function addWishlist($user=NULL,$deal=NULL){
        $this->db->set('user_id', $user);
        $this->db->set('deal_id', $deal);
		$result = $this->db->insert('wish_list');
		return $result;
    }
    function checkWishlist($user=NULL,$deal=NULL){
        $this->db->where('user_id', $user);
        $this->db->where('deal_id', $deal);
        $result = $this->db->get('wish_list');
		return $result->row();
    }
    /** The End*/
}