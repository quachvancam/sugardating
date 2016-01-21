<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class B2b extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('b2b_model');
    }

	function index()
	{
		$config['base_url'] = base_url().index_page().'/b2b/index/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] = $this->b2b_model->countAllDeal();
		$this->pagination->initialize($config);
		
		$deals = $this->b2b_model->loadAllDeal($config['per_page'], $this->uri->segment(3));
		$data['all_link']=$this->pagination->create_links();
        
        $dataDeal = "";
        if($deals){
            foreach($deals as $rows){
                $dataDeal[] = array(
                    'id' => $rows->id,
                    'name' => $rows->name,
                    'company' => $rows->company,
                    'description' => $rows->description,
                    'time' => $rows->time,
                    'end_date' => $rows->end_date,
                    'image1' => $rows->image1,
                    'red_icon' => $rows->red_icon,
                    'quantity' => $this->b2b_model->countSumDeal($rows->id),
                    );
            }
        }
        $data['deals'] = $dataDeal;
        $data['title'] = "B2B List";
	    $data['content'] = 'b2b/b2b_list';
		$this->load->view('template',$data,'');
	}
    
    function search(){
        $kw = $this->input->post('keyword');
        if($kw == ""){
            redirect(base_url().index_page().'b2b.html');
        }
        $deals = $this->b2b_model->loadAllDealName($kw);
		$data['all_link'] = "";
        
        $dataDeal = "";
        if($deals){
            foreach($deals as $rows){
                $dataDeal[] = array(
                    'id' => $rows->id,
                    'name' => $rows->name,
                    'company' => $rows->company,
                    'description' => $rows->description,
                    'time' => $rows->time,
                    'end_date' => $rows->end_date,
                    'image1' => $rows->image1,
                    'red_icon' => $rows->red_icon,
                    'quantity' => $this->b2b_model->countSumDeal($rows->id),
                    );
            }
        }
        $data['deals'] = $dataDeal;
        $data['title'] = "B2B List";
	    $data['content'] = 'b2b/b2b_list';
		$this->load->view('template',$data,'');
    }
    
	function edit($ID = NULL){
		$data['deal'] = $this->b2b_model->loadDealItems($ID);
        
		$data['title'] = "B2B Detail";
		$data['content'] = 'b2b/b2b_edit';
		$this->load->view('template',$data,'');
	}
	function updatedeal(){
        $ID = $this->input->post('id');
        $this->b2b_model->updateDeal($ID);
        
        return true;
    }
	function delete(){
		$ids = $this->input->post('id');
		foreach($ids as $id){
			$isOK = $this->b2b_model->deleteDeal($id);
			if(!$isOK){
				$this->session->set_flashdata('message', 'Can not delete');
	    		redirect(base_url().index_page().'b2b.html');
			}
		}
		$this->session->set_flashdata('message', 'Selected deal is deleted');
	    redirect(base_url().index_page().'b2b.html');
	}

	function close(){
		$this->session->set_flashdata('message', 'Operation is closed');
	    redirect(base_url().index_page().'b2b.html');
	}
}
?>