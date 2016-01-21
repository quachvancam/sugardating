<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller {

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
        
        /** Config for paypal (Test mode and Email)*/
        $testmode = 1; //0 test, 1 online
        $emailPaypal = "paypal@reddocksmedia.com"; //kim-facilitator@graphit.dk";
        $currency = "DKK";
        $language = "da_DK";
        /** End Config*/
		if ($testmode == 1) {
    		$data['action'] = 'https://www.paypal.com/cgi-bin/webscr';
  		} else {
			$data['action'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		}
        $data['charset'] = 'utf-8';
		$data['cmd'] = '_cart';
		$data['upload'] = '1';
        $data['tax_cart'] = number_format(0, 2, '.', '');

        $dataPro = "";
		foreach ($this->cart->contents() as $items) {
            $deal = $this->cart_model->loadDeal($items['id']);
            $dataPro[] = array(
                'item_number' => $deal->id,
                'item_name' => $deal->name,
                'amount' => number_format($items['price'], 2, '.', ''),
                'quantity' => $items['qty']
            );
        }
		$data['dataPro'] = $dataPro;
        
        $data['amount'] = number_format($this->cart->total(), 2, '.', '');
        $data['discount_amount_cart'] = number_format(0, 2, '.', '');
		$data['business'] = $emailPaypal;
		$data['currency_code'] = $currency;
		#$data['name'] = html_entity_decode($user->name, ENT_QUOTES, 'UTF-8');
		#$data['last_name'] = html_entity_decode(($user->name, ENT_QUOTES, 'UTF-8');
		#$data['address1'] = html_entity_decode($user->code." ".$user->city, ENT_QUOTES, 'UTF-8');
		#$data['city'] = html_entity_decode($user->city, ENT_QUOTES, 'UTF-8');
		#$data['zip'] = html_entity_decode($user->code, ENT_QUOTES, 'UTF-8');
		$data['email'] = $user->email;
		$data['invoice'] = $this->session->userdata('orderID') . ' - ' . html_entity_decode($user->name, ENT_QUOTES, 'UTF-8');
        $data['lc'] = $language;
        $data['return'] = base_url().index_page().'paypal/shop_success.html?'.$this->security->get_csrf_token_name().'='.$this->security->get_csrf_hash();
        $data['cancel_return'] = base_url().index_page().'paypal/shop_cancel.html?'.$this->security->get_csrf_token_name().'='.$this->security->get_csrf_hash();
        $data['notify_url'] = base_url().index_page().'paypal/shop_callback.html?'.$this->security->get_csrf_token_name().'='.$this->security->get_csrf_hash();
		$data['custom'] = $this->session->userdata('orderID');
       
        $data['title']='Sugar payment';
		$data['content']='sugarshop/paypal';
		$this->load->view('templates',$data,'');
	}
    
    function shop_success(){
        redirect(base_url().index_page().'sugarshop/confirm.html');
    }
    function shop_callback(){
        error_log($this->input->post('ordernumber'), 3, "/var/www/clients/client41/web347/web/error.log");
        //OK 
    }
    function shop_cancel(){
        $this->session->unset_userdata('ID');
        $this->session->unset_userdata('orderID');
        $this->cart->destroy();
        redirect(base_url().index_page().'index.html');
    }
    //The End
}
?>