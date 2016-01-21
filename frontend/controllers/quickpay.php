<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quickpay extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('user_model');
        $this->load->model('sugarshop_model');
        $this->load->model('cart_model');
    }
    function index(){
        
        $userCheck = $this->session->userdata('user');
        if($userCheck && $this->cart->total_items()>0){
            $user = getUser();
        }
        else{
            $this->cart->destroy();
            $this->session->sess_destroy();
            redirect(base_url().index_page().'start/');
        }
        //Payment
        $data['protocol'] = '6';
        $data['msgtype'] = 'authorize';
        $data['merchant'] = '89898978';
        $data['language'] = 'da';
        $data['ordernumber'] = $this->session->userdata('orderID');
        $data['amount'] = $this->cart->total()*100;
        $data['currency'] = 'DKK';
        $data['continueurl'] = base_url().index_page().'sugarshop/returnsite.html';
        $data['cancelurl'] = base_url().index_page().'sugarshop/cancel.html';
        $data['callbackurl'] = base_url().index_page().'sugarshop/callback.html';
        #$data['callbackurl'] = base_url().index_page().'sugarshop/callback/'.$this->session->userdata('ID').'.html';       
        $data['autocapture'] = 0; //0 disabled; 1 enabled
        #$data['cardtypelock'] = ''; //Full card
        #$data['cardtypelock'] = 'dankort,visa-dk,visa-electron,mastercard-dk,mastercard,visa-electron-dk,jcb,diners-dk,3d-maestro-dk,american-express-dk,diners,american-express,3d-maestro,fbg1886,visa,nordea-dk,danske-dk,edankort,mastercard-debet-dk';
        $data['cardtypelock'] = 'creditcard,american-express,american-express-dk,dankort,danske-dk,diners,diners-dk,edankort,fbg1886,jcb,mastercard,mastercard-dk,mastercard-debet-dk,nordea-dk,visa,visa-dk,visa-electron,visa-electron-dk';
        
        $data['description'] = 'description';
        $data['testmode'] = 1; //1 test; 0 online
        $data['splitpayment'] = 0;
        $md5word = '29p61DveBZ79c3144LW61lVz1qrwk2gfAFCxPyi5sn49m3Y3IRK5M6SN5d8a68u7';
        $data['md5check'] = md5($data['protocol'] . $data['msgtype'] . $data['merchant'] . $data['language'] . $data['ordernumber'] . $data['amount'] . $data['currency'] . $data['continueurl'] . $data['cancelurl'] . $data['callbackurl'] . $data['autocapture'] . $data['cardtypelock'] . $data['description'] . $data['testmode']. $data['splitpayment'] . $md5word);


        $data['user'] = $user;
        $data['tatal'] = $this->cart->total();
        
        $data['title']='Sugar payment';
		$data['content']='sugarshop/quickpay';
		$this->load->view('templates',$data,'');
    }
    function callback($orderID=NULL){
        //NULL
    }
    /** The end*/
}
?>