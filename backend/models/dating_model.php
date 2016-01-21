<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Dating_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function loadAllDating($num=NULL, $offset=NULL,$userID=NULL){
		$this->db->limit($num, $offset);
		$this->db->select('dating.*, user.name');
		$this->db->from('dating');
        $this->db->join('user', 'user.id = dating.user_id');
        $this->db->where('dating.user_id', $userID);
        $this->db->order_by('id','desc');
		$result = $this->db->get();	
		return $result->result();
	}
    function loadDatingName($kw=NULL, $userID=NULL){
		$this->db->select('dating.*, user.name');
		$this->db->from('dating');
        $this->db->join('user', 'user.id = dating.user_id');
        $this->db->where('dating.user_id', $userID);
        $this->db->like('title', $kw);
        $this->db->order_by('id','desc');
		$result = $this->db->get();	
		return $result->result();
	}
    function loadDeal($ID=NULL){
        $this->db->where('id', $ID);
		$result = $this->db->get('order_item');
		return $result->row();
    }
	function countAllDating($userID=NULL){
        $this->db->where('user_id', $userID);
        $this->db->from('dating');
		$result = $this->db->count_all_results();
		return $result;
	}
    
	function deleteDating($ID=NULL){
		$arr = array('id' => $ID); 
		$result = $this->db->delete('dating', $arr);
		return $result;
	}
    
}