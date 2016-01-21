<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Own_Model extends MX_Controller { 
    public function __construct() {
        parent::__construct(); 
    }
     
    function get_photo_quantity(){
        $user = getUser();
        $this->db->where('user_id', $user->id);
        $this->db->from('gallery');
        $result = $this->db->count_all_results();
        return $result;
    }
    
    function get_message_num($id){
        $this->db->select('COUNT(*) num');
        $this->db->from('messages');
		$this->db->where('to_id', $id);
        $this->db->where('seen', 0);
		$result = $this->db->get();
		return $result->row()->num;
    }
    
    function get_request_num($id){
        $this->db->select('COUNT(*) num');
        $this->db->from('friend_request');
		$this->db->where('to_id', $id);
		$result = $this->db->get();
		return $result->row()->num;
    }
    
    function get_friend_quantity($id){
        $this->db->select('COUNT(*) num');
        $this->db->from('friends f');
        $this->db->join('user u', 'f.to_id = u.id');
		$this->db->where('f.from_id', $id);
        $this->db->where('u.active', 1);
		$result = $this->db->get();
		return $result->row()->num;
    }
    
    function get_friends($id){
        $this->db->limit(15, 0);
        $this->db->select('u.*');
        $this->db->from('friends f');
        $this->db->join('user u', 'f.to_id = u.id');
		$this->db->where('f.from_id', $id);
        $this->db->where('u.active', 1);
		$result = $this->db->get();
		return $result->result();
    }
    function get_anmodning($id=NULL){
        $this->db->select('COUNT(*) num');
        $this->db->from('dating_apply');
        $where = "`user_id` = '".$id."' AND `status`=1";
        $this->db->where($where);
		$result = $this->db->get();
		return $result->row()->num;
    }
    function get_vip($id=NULL){
        $this->db->select('COUNT(*) num');
        $this->db->from('dating');
        $where = "`uservip` = '".$id."' AND `publish`=0 AND `used`=0";
        $this->db->where($where);
		$result = $this->db->get();
		return $result->row()->num;
    }
    
    function get_view_quantity($id){
        $this->db->select('COUNT(*) num');
        $this->db->from('viewprofile v');
        $this->db->join('user u', 'v.toid = u.id');
		$this->db->where('v.fromid', $id);
        $this->db->where('u.active', 1);
		$result = $this->db->get();
		return $result->row()->num;
    }
    
    function get_views($id){
        $this->db->limit(15, 0);
        $this->db->select('u.*');
        $this->db->from('viewprofile v');
        $this->db->join('user u', 'v.toid = u.id');
		$this->db->where('v.fromid', $id);
        $this->db->where('u.active', 1);
		$result = $this->db->get();
		return $result->result();
    }
}