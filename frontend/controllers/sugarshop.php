<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/** Check UTF-8 Lê Đức Cường */
class Sugarshop extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('user_model');
        $this->load->model('general_model');
        $this->load->model('sugarshop_model');
        $this->load->model('cart_model');
    }

    function index(){
        /** All category*/
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $user = "";
        }
        $data['dealcategorys'] = $this->sugarshop_model->loadDealCategorys();
        $config['base_url'] = base_url().index_page().'sugarshop/index/';
		$config['per_page'] = 12;
		$config['uri_segment'] = 3;
		$config['total_rows'] = $this->sugarshop_model->countAllDeal();
		$this->pagination->initialize($config);
		$data['deals'] = $this->sugarshop_model->loadAllDeal($config['per_page'], $this->uri->segment(3));
		$data['links'] = $this->pagination->create_links();
        
        $wishlist = "";
        if($data['deals']&&$user){
            foreach($data['deals'] as $rows){
                $check = $this->sugarshop_model->checkWishlist($user->id,$rows->id);
                if($check){
                    $wishlist[] = array(
                        'id' => $rows->id,
                    );
                }
                else{
                    $wishlist[] = array(
                        'id' => 0,
                    );
                }
                
            }
        }
        $data['wishlist'] = $wishlist;
        $data['user'] = $user;
        $data['title']='Sugar shop';
		$data['content']='sugarshop/index';
		$this->load->view('templates',$data,'');
    }
    
    function searchcategory(){
        /** All category*/
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $user = "";
        }
        $data['dealcategorys'] = $this->sugarshop_model->loadDealCategorys();
        if($this->input->post('dealcategory', true)){
            $categoryID = $this->input->post('dealcategory', true);
            $this->session->set_userdata('categoryID', $categoryID);
        }
        else{
            $categoryID = $this->session->userdata('categoryID');
        }
        if($categoryID == "alle"){
            $categoryID = "";
        }
        
        $config['base_url'] = base_url().index_page().'sugarshop/searchcategory/';
		$config['per_page'] = 12;
		$config['uri_segment'] = 3;
		$config['total_rows'] = $this->sugarshop_model->countAllDeal($categoryID);
		$this->pagination->initialize($config);
		
		$data['deals'] = $this->sugarshop_model->loadAllDeal($config['per_page'], $this->uri->segment(3), $categoryID);
		$data['links'] = $this->pagination->create_links();
		$data['categoryID'] = $categoryID;
        
        $wishlist = "";
        if($data['deals']&&$user){
            foreach($data['deals'] as $rows){
                $check = $this->sugarshop_model->checkWishlist($user->id,$rows->id);
                if($check){
                    $wishlist[] = array(
                        'id' => $rows->id,
                    );
                }
                else{
                    $wishlist[] = array(
                        'id' => 0,
                    );
                }
                
            }
        }
        
        $data['wishlist'] = $wishlist;
        $data['user'] = $user;
        $data['title']='Sugar shop';
		$data['content']='sugarshop/category';
		$this->load->view('templates',$data,'');
    }
    
    function searchname(){
        /** All category*/
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $user = "";
        }
        $data['dealcategorys'] = $this->sugarshop_model->loadDealCategorys();
        if($this->input->post('name', true)){
            $name = $this->input->post('name', true);
            $this->session->set_userdata('name', $name);
        }
        else{
            $name = $this->session->userdata('name');
        }
        $config['base_url'] = base_url().index_page().'sugarshop/searchname/';
		$config['per_page'] = 12;
		$config['uri_segment'] = 3;
		$config['total_rows'] = $this->sugarshop_model->countAllDealName($name);
		$this->pagination->initialize($config);
		
		$data['deals'] = $this->sugarshop_model->loadAllDealName($config['per_page'], $this->uri->segment(3), $name);
		$data['links'] = $this->pagination->create_links();
		$data['name'] = $name;
        
        $wishlist = "";
        if($data['deals']&&$user){
            foreach($data['deals'] as $rows){
                $check = $this->sugarshop_model->checkWishlist($user->id,$rows->id);
                if($check){
                    $wishlist[] = array(
                        'id' => $rows->id,
                    );
                }
                else{
                    $wishlist[] = array(
                        'id' => 0,
                    );
                }
                
            }
        }
        
        $data['wishlist'] = $wishlist;
        $data['user'] = $user;
        
        $data['title']='Sugar shop';
		$data['content']='sugarshop/search';
		$this->load->view('templates',$data,'');
    }
    
    function detail($id = NULL){
        
        $data['deals'] = $this->sugarshop_model->loadDeal($id);
        if($this->session->userdata('user')){
            $data['activities'] = $this->user_model->load_activities();
        } else {
            $data['activities'] = NULL;
        }
        
        $data['title']='Sugar shop';
		$data['content']='sugarshop/detail';
		$this->load->view('templates',$data,'');
    }
    function checkout(){
        
        if(!$this->cart->total_items()>0){
            redirect(base_url().index_page().'cart/index.html');
        }
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
            $b2b = $this->session->userdata('b2b');
        }
        else{
            $user = "";
            $b2b = "";
        }
        $dataPro = "";
        if($this->cart->total_items()>0){
            foreach ($this->cart->contents() as $items){
                $deal = $this->cart_model->loadDeal($items['id']);
                $dataGift = $this->session->userdata($items['id']);
                if($dataGift){
                    $dataGift = $dataGift;
                }
                else{
                    $dataGift = "";
                }
                $dataPro[] = array(
                    'rowid' => $items['rowid'],
                    'id' => $items['id'],
                    'qty' => $items['qty'],
                    'name' => $deal->name,
                    'image' => $deal->image1,
                    'dec' => $deal->description,
                    'price_old' => $deal->old_price,
                    'price' => $items['price'],
                    'dataGift' => $dataGift,
                    );
            }
        }
        else{
            $this->cart->destroy();
        }
        $data['user'] = $user;
        $data['b2b'] = $b2b;
        $data['cart'] = $dataPro;
        $data['items'] = $this->cart->total_items();
        $data['tatal'] = $this->cart->total();
        
        $data['title']='Sugar checkout';
		$data['content']='sugarshop/checkout';
		$this->load->view('templates',$data,'');
    }
    function payment(){
        
        $userCheck = $this->session->userdata('user');
        if($userCheck && $this->cart->total_items()>0){
            $user = getUser();
        }
        else{
            $this->cart->destroy();
            $this->session->sess_destroy();
            redirect(base_url().index_page().'index.html');
        }
        //Create order
        if($this->session->userdata('orderID')){
            $order['orderID'] = $this->session->userdata('orderID');
        }else{
            $this->session->set_userdata('orderID', "S".time());
            $order['orderID'] = $this->session->userdata('orderID');
        }
        $order['user_id'] = $user->id;
        $order['total'] = $this->cart->total();
        $order['status'] = 0;
        $order['time'] = time();
        $catID = "";
        
        if($this->session->userdata('ID')){
            //Update order
            $this->sugarshop_model->updateOrder($order, $this->session->userdata('ID'));
            $this->sugarshop_model->deleteItems($this->session->userdata('ID'));
            //Add items
            foreach ($this->cart->contents() as $items){
                $deal = $this->cart_model->loadDeal($items['id']);
                $dataGift = $this->session->userdata($items['id']);
                if($dataGift){
                    $data['namegift'] = $dataGift['namegift'];
                    $data['emailgift'] = $dataGift['emailgift'];
                    $data['sendtomail'] = $dataGift['sendtomail'];
                    $data['fromgift'] = $dataGift['fromgift'];
                    $data['textgift'] = $dataGift['textgift'];
                }
                else{
                    $data['namegift'] = "";
                    $data['emailgift'] = "";
                    $data['sendtomail'] = "";
                    $data['fromgift'] = "";
                    $data['textgift'] = "";
                }
                $data['order_id'] = $this->session->userdata('ID');
                $data['deal_id'] = $items['id'];
                $data['category_id'] = $deal->category_id;
                $catID .= $deal->category_id.",";
                $data['name'] = $deal->name;
                $data['quantity'] = $items['qty'];
                $data['old_price'] = $deal->old_price;
                $data['new_price'] = $items['price'];
                $data['subtotal'] = $items['price']*$items['qty'];
                $data['codes'] = "SG-".rand(1000,9999)."-".rand(1000,9999);
                $data['times'] = time();
                
                $this->sugarshop_model->addItems($data);
            }
            $cat['cat_id'] = $catID;
            $this->sugarshop_model->updateOrder($cat, $this->session->userdata('ID'));
        }
        else{
            //Create order
            $ID = $this->sugarshop_model->createOrder($order);
            $this->session->set_userdata('ID', $ID);
            //Add items
            foreach ($this->cart->contents() as $items){
                $deal = $this->cart_model->loadDeal($items['id']);
                $dataGift = $this->session->userdata($items['id']);
                if($dataGift){
                    $data['namegift'] = $dataGift['namegift'];
                    $data['emailgift'] = $dataGift['emailgift'];
                    $data['sendtomail'] = $dataGift['sendtomail'];
                    $data['fromgift'] = $dataGift['fromgift'];
                    $data['textgift'] = $dataGift['textgift'];
                }
                else{
                    $data['namegift'] = "";
                    $data['emailgift'] = "";
                    $data['sendtomail'] = "";
                    $data['fromgift'] = "";
                    $data['textgift'] = "";
                }
                $data['order_id'] = $this->session->userdata('ID');
                $data['deal_id'] = $items['id'];
                $data['category_id'] = $deal->category_id;
                $catID .= $deal->category_id.",";
                $data['name'] = $deal->name;
                $data['quantity'] = $items['qty'];
                $data['old_price'] = $deal->old_price;
                $data['new_price'] = $items['price'];
                $data['subtotal'] = $items['price']*$items['qty'];
                $data['codes'] = "SG-".rand(1000,9999)."-".rand(1000,9999);
                $data['times'] = time();
                
                $this->sugarshop_model->addItems($data);
            }
            $cat['cat_id'] = $catID;
            $this->sugarshop_model->updateOrder($cat, $this->session->userdata('ID'));   
        }
        //Payment
        #redirect(base_url().index_page().'quickpay/index.html');
        redirect(base_url().index_page().'paypal/index.html');
    }
    function confirm(){
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $this->cart->destroy();
            $this->session->sess_destroy();
            redirect(base_url().index_page().'index.html');
        }
        
        $ID = $this->session->userdata('ID');
        if($ID){
            $this->sendEmail();
            $data['status'] = 1;
            $this->sugarshop_model->updateOrder($data, $ID);
            /** Update quantity for deal*/
            $dealItems = $this->sugarshop_model->selectOrderItems($ID);
            if($dealItems){
                foreach($dealItems as $rows){
                    //Select quantitybuy
                    $deal = $this->sugarshop_model->loadDeal($rows->deal_id);
                    $quantity['quantitybuy'] = $deal->quantitybuy + 1;
                    //Update again quantitybuy
                    $this->sugarshop_model->updateDeal($rows->deal_id,$quantity);
                    //Add activity of user
                    $activity['user_id'] = $user->id;
                    $activity['type'] = 3;
                    $activity['content_id'] = 0;
                    $activity['data'] = $deal->name;
                    $activity['time'] = time();
                    $this->general_model->addActivity($activity);
                }
            }
            /** End Update quantity for deal*/
        }
        $order = $this->sugarshop_model->selectOrder($ID);
        if($order){
            $data['order'] = $order;
        }
        else{
            $data['order'] = "";
        }
        $orderItems = $this->sugarshop_model->selectOrderItems($ID);
        if($orderItems){
            $data['orderItems'] = $orderItems;
        }
        else{
            $data['orderItems'] = "";
        }
                
        $data['orderID'] = $this->session->userdata('orderID');
        $data['user'] = $user;
        
        /** Clear cart and order*/
        $this->session->unset_userdata('ID');
        $this->session->unset_userdata('orderID');
        $this->cart->destroy();
        
        $data['title']='Sugar confirm';
		$data['content']='sugarshop/confirm';
		$this->load->view('templates',$data,'');
    }
    function sendEmail(){
        /** Send mail member buy deal*/
        $configEmail['mailtype'] = 'html';   
	    $this->load->library('email', $configEmail);
	    $this->email->set_newline("\r\n");
	    $this->email->initialize($configEmail);
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
            $to = $user->email;
        }
        else{
            $to = "nguyen.cuong@mwc.vn";
        }
        $from = "kundeservice@sugardating.dk";
        $orderID = $this->session->userdata('orderID');
        $subject = "Sugardating.dk Ordrebekræftelse - ".$orderID;
        $ID = $this->session->userdata('ID');
        $order = $this->sugarshop_model->selectOrder($ID);
        $orderItems = $this->sugarshop_model->selectOrderItems($ID);
        $content = '<!DOCTYPE HTML>
                    <html>
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Tak for dit køb på Sugardating.dk</title>
                    </head>
                    <body style="font-size:100%; color: #000; font: normal 15px  Helvetica, Arial, sans-serif;">
                    <table style="width:830px; margin: 0 auto;" width="800" border="1" cellspacing="0" cellpadding="0">
                     <tr>
                        <td>
                           <table style=" width: 800px; margin: 0 15px; font-family: Helvetica ,Arial, sans-serif;   font-size:14px; color: #282828;"  border="0" cellspacing="0"cellpadding="0" hspace="0" >
                              <tr>
                                 <td style=" font-size:34px; color:#000; padding-top:15px;  padding-bottom:5px;" colspan="2">Tak for dit køb på Sugardating.dk</td>
                              </tr>
                              <tr>
                                 <td colspan="2" style="font-weight: bold; font-size:20px; padding-bottom:5px;  ">Ordrenummer: '.$orderID.'</td>
                              </tr>
                              <tr>
                                 <td colspan="2">
                                    <table  cellspacing="0" cellpadding="5" style="font-family: Helvetica ,Arial, sans-serif;  border-left: 1px solid #aaa;  margin-bottom:15px; width:800px; font-size:14px;">
                                       <tr style="color: #fff; text-align: left; font-size: 14px; background: #aaaaaa;" bgcolor="#aaaaaa" >
                                          <td style="width:200px;"><strong>Valgt</strong></td>
                                          <td style="width:250px;"><strong>Beskrivelse</strong></td>
                                          <td style="width:90px;"><strong>Stk pris</strong></td>
                                          <td style="width:60px;"><strong>%Sugar</strong></td>
                                          <td style="text-align:center; width:50px;"><strong>Antal</strong></td>
                                          <td style="width:100px;text-align: right;"><strong>Pris</strong></td>
                                       </tr>';
                                       
                              $total = 0;
                              if($orderItems){foreach($orderItems as $rows){
                              $total += $rows->quantity*$rows->new_price;        
                              $content .= '<tr>
                                          <td valign="top" style="border-right:1px solid #aaa; border-bottom:1px solid #aaa;">'.$rows->name.'</td>
                                          <td valign="top" style="border-right:1px solid #aaa; border-bottom:1px solid #aaa;">'.$rows->description.'</td>
                                          <td valign="top" style="border-right:1px solid #aaa; border-bottom:1px solid #aaa;">'.priceFormat($rows->old_price).'</td>
                                          <td valign="top" style="border-right:1px solid #aaa; border-bottom:1px solid #aaa;">'.priceFormat($rows->old_price-$rows->new_price).'</td>
                                          <td valign="top" style="border-right:1px solid #aaa; border-bottom:1px solid #aaa;text-align:center;">'.$rows->quantity.'</td>
                                          <td valign="top" style="border-right:1px solid #aaa; border-bottom:1px solid #aaa;width:100px;text-align: right;">'.priceFormat($rows->quantity*$rows->new_price).'</td>
                                       </tr>';
                                       
                                    }}
                              $content .= '</table>
                                 </td>
                              </tr>
                              <tr>
                                 <td width="288">&nbsp;</td>
                                 <td width="450" style="text-align: right;">
                                    <table style="font-family: Helvetica ,Arial, sans-serif; float: right; font-weight:bold; font-size: 15px;" width="420"  cellspacing="0" cellpadding="10">
                                       <tr>
                                          <td style="text-align: right; border-bottom: 1px solid #aaaaaa;padding-right: 45px;" >Subtotal inkl. moms:</td>
                                          <td style="text-align: right; border-bottom: 1px solid #aaaaaa; width:100px;text-align: right;">'.priceFormat($total).'</td>
                                       </tr>
                                       <tr>
                                          <td style="text-align: right; border-bottom: 1px solid #aaaaaa;padding-right: 45px;" >Heraf moms:</td>
                                          <td style="text-align: right; border-bottom: 1px solid #aaaaaa; width:100px;text-align: right;">'.priceFormat($total*0.2).'</td>
                                       </tr>
                                       <tr>
                                          <td style="text-align: right; border-bottom: 1px solid #aaaaaa;padding-right: 45px;" >Total inkl. moms:</td>
                                          <td style="text-align: right; border-bottom: 1px solid #aaaaaa; width:100px;text-align: right;">'.priceFormat($total).'</td>
                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td style="font-weight: bold; font-size:20px;padding-bottom:5px;">
                                    Sugardating.dk<br />
                                    kundeservice@sugardating.dk<br />
                                    CVR-nr. 27 36 46 08<br />
                                    1663 København V<br />
                                 </td>
                                 <td>&nbsp;</td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>
                  </body>
                  </html>';
        $this->email->clear();
        $this->email->to($to);
        $this->email->from($from,'Christina, Sugardating.dk');
        $this->email->subject($subject);
        $this->email->message($content);
        $this->email->send();
    }
    function sendEmailGift(){
        $configEmail['mailtype'] = 'html';    
	    $this->load->library('email', $configEmail);
	    $this->email->set_newline("\r\n");
	    $this->email->initialize($configEmail);
        
        /** Send email deal gif to friend*/
        $subject = "Sugardating.dk Ordrebekræftelse - ".$orderID;
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
            $from = $user->email;
        }

        $orderItems = $this->sugarshop_model->selectOrderItems($ID);

        $to = "";
         
        $content = "";

        $this->email->clear();
        $this->email->to($to);
        $this->email->from($from);
        $this->email->subject($subject);
        $this->email->message($content);
        #$this->email->send();
    }
    function mydeal(){
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $this->session->sess_destroy();
            redirect(base_url().index_page().'start/');
        }
        $data['mydeals'] = $this->sugarshop_model->loadDealByUser($user->id);
        $data['title']='Mine deals';
		$data['content']='sugarshop/mydeal';
		$this->load->view('templates',$data,'');
    }
    
    function mypurchase($id){
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $this->session->sess_destroy();
            redirect(base_url().index_page().'start/');
        }
        $data['mydeals'] = $this->sugarshop_model->loadPurchaseByUser($id);
        $data['userid'] = $id;
        $data['title'] = 'Mine purchase';
		$data['content'] = 'sugarshop/mypurchase';
		$this->load->view('templates',$data,'');
    }
    
    function mygift(){
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $this->session->sess_destroy();
            redirect(base_url().index_page().'start/');
        }
        $data['mydeals'] = $this->sugarshop_model->loadGiftByUser($user->id);
        $data['title']='Mine gift';
		$data['content']='sugarshop/mygift';
		$this->load->view('templates',$data,'');
    }
    
    function printdeal($ID=NULL){
        $data['deals'] = $this->sugarshop_model->loadDealItems($ID);
        
        $data['title']='Udskriv mine deals';
		$this->load->view('content/sugarshop/printdeal',$data,'');
    }
    function wishlist(){
        $userID = $this->input->post('user');
        $dealID = $this->input->post('deal');
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
            if($user->id == $userID){
                $this->sugarshop_model->addWishlist($userID, $dealID);
                return true;
            }
            else{
                $this->session->sess_destroy();
                redirect(base_url().index_page().'start/');
            }
        }
        else{
            $this->session->sess_destroy();
            redirect(base_url().index_page().'start/');
        }
    }    
    /** The end*/
}
?>