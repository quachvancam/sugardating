<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wishlist extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('wishlist_model');
    }
	function index($userID=NULL)
	{
		$config['base_url'] = base_url().index_page().'/wishlist/index/'.$userID.'/';
		$config['per_page'] = get_item_per_page();
		$config['uri_segment'] = 3;
		
		$config['total_rows'] = $this->wishlist_model->countAllWishlist($userID);
		$this->pagination->initialize($config);
		$data['wishlist'] = $this->wishlist_model->loadAllWishlist($config['per_page'], $this->uri->segment(4),$userID);
		$data['all_link']=$this->pagination->create_links();
        
        $data['userid'] = $userID;
        $data['title'] = "Wishlist List";
	    $data['content'] = 'wishlist/wishlist_list';
		$this->load->view('template',$data,'');
	}
	function delete(){
		$ids = $this->input->post('id');
        $userID = $this->input->post('userid');
        foreach($ids as $id){
			$this->wishlist_model->deleteWishlist($id);
		}
		$this->session->set_flashdata('message', 'Selected deal is deleted');
	    redirect(base_url().index_page().'wishlist/index/'.$userID);
	}
	
    function search($userID){
        $kw = $this->input->post('keyword');
        if($kw == ""){
            redirect(base_url().index_page().'wishlist/index/'.$userID);
        }
        $data['wishlist'] = $this->wishlist_model->loadAllWishlistName($kw,$userID);
		$data['all_link'] = "";
        
        $data['userid'] = $userID;
        $data['title'] = "Wishlist List";
	    $data['content'] = 'wishlist/wishlist_list';
		$this->load->view('template',$data,'');
	}
}
?>