<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Common_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function update_status($table, $id, $status){
		$query = "UPDATE ".$table." SET publish = ".$status." WHERE id = ".$id;
		$result = $this->db->query($query);
		return $result;
	}
    
    function update_expiry($table, $id, $status){
		$query = "UPDATE ".$table." SET expiry = ".$status." WHERE id = ".$id;
		$result = $this->db->query($query);
		return $result;
	}
    
     function order_update($id_arr, $order_arr, $table){
        for($i=0; $i<count($id_arr); $i++){
            $this->db->set('ordering', $order_arr[$i]);
            $this->db->where('id', $id_arr[$i]);
            $result = $this->db->update($table);
            if(!$result) return false;
        }
        
        return true;
    }
}