<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('order_model');
    }
	function index()
	{
		$config['base_url'] = base_url().index_page().'/order/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] = $this->order_model->countAllOrder();
		$this->pagination->initialize($config);
		$data['order'] = $this->order_model->loadAllOrder($config['per_page'], $this->uri->segment(3));
		$data['all_link']=$this->pagination->create_links();
        
        $data['title'] = "Order List";
	    $data['content'] = 'order/order_list';
		$this->load->view('template',$data,'');
	}
	function edit($ID = NULL){
		
        $data['order'] = $this->order_model->loadOrder($ID);
        $data['items'] = $this->order_model->loadOrderItem($ID);
        
		$data['title'] = "Order Detail";
		$data['content'] = 'order/order_edit';
		$this->load->view('template',$data,'');
	}
	function delete(){
		$ids = $this->input->post('id');
        foreach($ids as $id){
            $this->order_model->deleteOrderItem($id);
			$this->order_model->deleteOrder($id);
		}
		$this->session->set_flashdata('message', 'Selected deal is deleted');
	    redirect(base_url().index_page().'order.html');
	}
	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect(base_url().index_page().'order.html');
	}
    
    function search(){
        $kw = $this->input->post('keyword');
        if($kw == ""){
            redirect(base_url().index_page().'order.html');
        }
        $data['order'] = $this->order_model->loadAllOrderName($kw);
		$data['all_link'] = "";
        $data['title'] = "Order List";
	    $data['content'] = 'order/order_list';
		$this->load->view('template',$data,'');
	}
}
?>