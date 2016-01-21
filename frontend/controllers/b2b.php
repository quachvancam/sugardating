<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class B2b extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('user_model');
        $this->load->model('b2b_model');
    }
    function index(){
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $this->session->sess_destroy();
            redirect(base_url().index_page().'index.html');
        }
        $deals = $this->b2b_model->loadAllDeal($user->id);
        
        $dataDeal = "";
        if($deals){
            foreach($deals as $rows){
                $dataDeal[] = array(
                    'id' => $rows->id,
                    'name' => $rows->name,
                    'description' => $rows->description,
                    'time' => $rows->time,
                    'end_date' => $rows->end_date,
                    'image1' => $rows->image1,
                    'red_icon' => $rows->red_icon,
                    'quantity' => $this->b2b_model->countSumDeal($rows->id),
                    );
            }
        } 
        
        $data['deal'] = $dataDeal;
        $data['title'] = 'B2B Shop';
		$data['content'] = 'b2b/index';
		$this->load->view('templates',$data,'');
    }
    function search(){
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $this->session->sess_destroy();
            redirect(base_url().index_page().'index.html');
        }
        $kw = $this->input->post('keyword');
        if($kw == ""){
            redirect(base_url().index_page().'b2b/index.html');
        }
        $deals = $this->b2b_model->loadAllDeal($user->id, $kw);
        $dataDeal = "";
        if($deals){
            foreach($deals as $rows){
                $dataDeal[] = array(
                    'id' => $rows->id,
                    'name' => $rows->name,
                    'description' => $rows->description,
                    'time' => $rows->time,
                    'end_date' => $rows->end_date,
                    'image1' => $rows->image1,
                    'red_icon' => $rows->red_icon,
                    'quantity' => $this->b2b_model->countSumDeal($rows->id),
                    );
            }
        } 
        
        $data['deal'] = $dataDeal;
        $data['title'] = 'B2B Shop';
		$data['content'] = 'b2b/index';
		$this->load->view('templates',$data,'');
    }
    
    function detail($ID=NULL){
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $this->session->sess_destroy();
            redirect(base_url().index_page().'start/');
        }
        $data['deal'] = $this->b2b_model->loadDealItems($ID);
        $data['id'] = $ID;
        $data['title'] = 'B2B Detail';
		$data['content'] = 'b2b/detail';
		$this->load->view('templates',$data,'');
    }
    function searchdetail(){
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $this->session->sess_destroy();
            redirect(base_url().index_page().'start/');
        }
        
        $code = $this->input->post('code', true);
        $ID = $this->input->post('dealid', true);
        
        $data['deal'] = $this->b2b_model->loadDealItems($ID,$code);
        $data['id'] = $ID;
        $data['title'] = 'B2B Detail';
		$data['content'] = 'b2b/detail';
		$this->load->view('templates',$data,'');
    }
    
    function updatedeal(){
        $ID = $this->input->post('id');
        $this->b2b_model->updateDeal($ID);
        
        return true;
    }
}
?>