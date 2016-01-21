<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
    }

	function change_num(){
		$item_per_page = $this->input->post('item_per_page');
        $return = $this->input->post('return');
		$this->session->set_userdata('item_per_page', $item_per_page);
		
		redirect($return);
	}
    
    function publish(){
		$table = $this->input->post('table');
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$isOK = $this->common_model->update_status($table, $id, $status);
		if($isOK){
			echo 1;
			exit;
		} else {
			echo 0;
			exit;
		}
	}
    
    function expiry(){
		$table = $this->input->post('table');
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$isOK = $this->common_model->update_expiry($table, $id, $status);
		if($isOK){
			echo 1;
			exit;
		} else {
			echo 0;
			exit;
		}
	}
    
    function sort_order(){
        $id_arr = array_keys($this->input->post('ordering'));
        $order_arr = array_values($this->input->post('ordering'));
        $table = $this->input->post('table');
        $return = $this->input->post('return_url');
        $isOK = $this->common_model->order_update($id_arr, $order_arr, $table);
        
        if($isOK){
			$this->session->set_flashdata('message', 'The items is sorted');
	    	redirect('/'.$return);
		} else {
			$this->session->set_flashdata('message', 'Can\'t sort the items');
	    	redirect('/'.$return);
		}
    }
}
?>