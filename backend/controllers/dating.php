<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dating extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('dating_model');
    }
	function index($userID=NULL)
	{
		$config['base_url'] = base_url().index_page().'/dating/index/'.$userID.'/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3;
		
		$config['total_rows'] = $this->dating_model->countAllDating($userID);
		$this->pagination->initialize($config);
		$data['dating'] = $this->dating_model->loadAllDating($config['per_page'], $this->uri->segment(4),$userID);
		$data['all_link']=$this->pagination->create_links();
        
        $deal = "";
        if($data['dating']){
            foreach($data['dating'] as $rows){
                if($rows->order_item_id>0){
                    $deals = $this->dating_model->loadDeal($rows->order_item_id);
                    $deal[] = array(
                        'deal' => $deals->name,
                    );
                }
                else{
                    $deal[] = array(
                        'deal' => "",
                    );
                }    
            }
        }
        $data['deal'] = $deal;
        $data['userid'] = $userID;
        $data['title'] = "Dating List";
	    $data['content'] = 'dating/dating_list';
		$this->load->view('template',$data,'');
	}
    function search($userID=NULL){
        $kw = $this->input->post('keyword');
        if($kw == ""){
            redirect(base_url().index_page().'dating/index/'.$userID);
        }
        $data['dating'] = $this->dating_model->loadDatingName($kw, $userID);
		$data['all_link'] = "";
        $deal = "";
        if($data['dating']){
            foreach($data['dating'] as $rows){
                if($rows->order_item_id>0){
                    $deals = $this->dating_model->loadDeal($rows->order_item_id);
                    $deal[] = array(
                        'deal' => $deals->name,
                    );
                }
                else{
                    $deal[] = array(
                        'deal' => "",
                    );
                }    
            }
        }
        $data['deal'] = $deal;
        $data['userid'] = $userID;
        $data['title'] = "Dating List";
	    $data['content'] = 'dating/dating_list';
		$this->load->view('template',$data,'');
    }
	function delete(){
		$ids = $this->input->post('id');
        $userID = $this->input->post('userid');
        foreach($ids as $id){
			$this->dating_model->deleteDating($id);
		}
		$this->session->set_flashdata('message', 'Selected deal is deleted');
	    redirect(base_url().index_page().'dating/index/'.$userID);
	}
}
?>