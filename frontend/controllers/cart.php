<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/** Utf-8 Cường*/
class Cart extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('user_model');
        $this->load->model('cart_model');
    }
    function index(){
        
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
                    'title' => $deal->title,
                    'price_old' => $deal->old_price,
                    'price' => $items['price'],
                    'dataGift' => $dataGift,
                    );
            }
        }
        else{
            $this->cart->destroy();
        }
        $data['cart'] = $dataPro;
        $data['items'] = $this->cart->total_items();
        $data['tatal'] = $this->cart->total();
        
        $data['title']='Sugar Indkøbskurv';
		$data['content']='sugarshop/cart';
		$this->load->view('templates',$data,'');
    }
    
    function insert(){
        
        $pro = $this->input->post('dataInput');
        $dataCart = array(
            'id'      => $pro['id'],
            'qty'     => $pro['qty'],
            'price'   => $pro['price'],
            'name'    => 'Name pro'
        );
        $this->cart->insert($dataCart);
        $dataPro = "";
        if($this->cart->total_items()>0){
            foreach ($this->cart->contents() as $items){
                $deal = $this->cart_model->loadDeal($items['id']);
                $dataPro[] = array(
                    'rowid' => $items['rowid'],
                    'id' => $items['id'],
                    'qty' => $items['qty'],
                    'name' => $deal->name,
                    'image' => $deal->image1,
                    'price' => $items['price'],
                    );
            }
        }
        else{
            $this->cart->destroy();
        }
        $data['cart'] = $dataPro;
        $data['items'] = $this->cart->total_items();
        $data['tatal'] = $this->cart->total();
		$this->load->view('content/sugarshop/miniCart',$data,'');
    }
    function insertgift(){
        
        $pro = $this->input->post('dataInput');
        $dataCart = array(
            'id'      => $pro['id'],
            'qty'     => $pro['qty'],
            'price'   => $pro['price'],
            'name'    => 'Name pro'
        );
        $this->cart->insert($dataCart);
        //Add session Gift
        $dataGift = array(
            'namegift'      => $pro['namegift'],
            'emailgift'     => $pro['emailgift'],
            'sendtomail'    => $pro['sendtomail'],
            'fromgift'      => $pro['fromgift'],
            'textgift'      => $pro['textgift'],
        );
        $id = $pro['id'];
        $this->session->set_userdata($id, $dataGift);
        if($this->cart->total_items()>0){
            foreach ($this->cart->contents() as $items){
                $deal = $this->cart_model->loadDeal($items['id']);
                $dataPro[] = array(
                    'rowid' => $items['rowid'],
                    'id' => $items['id'],
                    'qty' => $items['qty'],
                    'name' => $deal->name,
                    'image' => $deal->image1,
                    'price' => $items['price'],
                    );
            }
        }
        else{
            $this->cart->destroy();
        }
        $data['cart'] = $dataPro;
        $data['items'] = $this->cart->total_items();
        $data['tatal'] = $this->cart->total();
		$this->load->view('content/sugarshop/miniCart',$data,'');
    }
    function update($rowid=NULL, $id=NULL, $qty=0){
        $data = array(
            'rowid' => $rowid,
            'qty'   => $qty
        );
        $this->cart->update($data);
        if($id){
            $this->session->unset_userdata($id);
        }
        redirect(base_url().index_page().'cart/index.html');  
    }
    function delete(){
        $this->cart->destroy();
        redirect(base_url().index_page().'cart/index.html');
    }
    function minicart(){
        $dataPro = "";
        if($this->cart->total_items()>0){
            foreach ($this->cart->contents() as $items){
                $deal = $this->cart_model->loadDeal($items['id']);
                $dataPro[] = array(
                    'rowid' => $items['rowid'],
                    'id' => $items['id'],
                    'qty' => $items['qty'],
                    'name' => $deal->name,
                    'image' => $deal->image1,
                    'price' => $items['price'],
                    );
            }
        }
        else{
            $this->cart->destroy();
        }
        $data['cart'] = $dataPro;
        $data['items'] = $this->cart->total_items();
        $data['tatal'] = $this->cart->total();
		$this->load->view('content/sugarshop/miniCart',$data,'');
    }
}
?>