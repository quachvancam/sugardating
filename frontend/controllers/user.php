<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once APPPATH.'libraries/facebook/facebook.php';

class User extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('user_model');
        $this->load->model('general_model');
        $this->load->model('cart_model');
        $this->config->load('facebook');
    }
    
    function index(){
        redirect(base_url().index_page().'user/owner.html');
    }
    
    function login(){
        $this->load->view('login');$data['user'] = getUser();
    }

    function logins(){
        $email = $this->input->post('email');
	    $password = md5($this->input->post('password'));
        $return = $this->input->post('return');
        $return = $return ? $return : base_url().index_page().'index.html';
        if($this->input->post('password')){
            $cookie = array('name'=>'email', 'value'=>$this->input->post('email'), 'expire'=>360000000);
            $this->input->set_cookie($cookie);
            $cookie = array('name'=>'password', 'value'=>$this->input->post('password'), 'expire'=>360000000);
            $this->input->set_cookie($cookie);
        }
        
		$result = $this->user_model->check_b2b_login($email,$password);
        if($result->num_rows()>0) {
			$row = $result->row();
			if($row->publish){
                $user = new stdClass();
                $user->id       = $row->id;
                $user->email    = $row->email;
                $user->name     = $row->name;
                $user->company  = $row->company;
                $user->image    = $row->image;
                $user->b2b      = true;
				$this->user_model->update_login($row->id, true);
				$this->session->set_userdata('user', $user);
                $this->session->set_userdata('b2b', true);
                $this->session->set_userdata('isLogged', true);
                redirect(base_url().index_page().'b2b/index.html');	
			}
		}
        
        $result = $this->user_model->check_login($email,$password);
		if($result->num_rows()>0) {
			$row = $result->row();
			if($row->publish){
                $user = new stdClass();
                $user->id   = $row->id;
                $user->b2b  = false;
                $this->session->set_userdata('userid', $row->id);
				$this->user_model->update_login($row->id);
				$this->session->set_userdata('user', $user);
                $this->session->set_userdata('b2b', false);
                $this->session->set_userdata('isLogged', true);

                if($this->cart->total_items()>0){
                    redirect(base_url().index_page().'sugarshop/checkout.html');
                }
                else{
				    redirect(base_url().index_page().'user/owner.html');
                }

			} else {
				$this->session->set_flashdata('message', 'Denne konto er ikke aktiveret endnu');
	        	redirect($return);
			}
		}
		else
		{
	        $this->session->set_flashdata('message', 'Beklager, vi genkender ikke email eller adgangskode. Prøv igen');
	        redirect($return);
		}
    }
    
    function auto_login(){
        $email = $this->session->userdata('email');
	    $password = md5($this->session->userdata('password'));
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('password');
        $return = $this->input->post('return');
        $return = $return ? $return : base_url().index_page().'index.html';
        if($this->input->post('password')){
            $cookie = array('name'=>'email', 'value'=>$email, 'expire'=>360000000);
            $this->input->set_cookie($cookie);
            $cookie = array('name'=>'password', 'value'=>$password, 'expire'=>360000000);
            $this->input->set_cookie($cookie);
        }
		$result = $this->user_model->check_b2b_login($email,$password);
        if($result->num_rows()>0) {
			$row = $result->row();
			if($row->publish){
                $user = new stdClass();
                $user->id       = $row->id;
                $user->email    = $row->email;
                $user->name     = $row->name;
                $user->company  = $row->company;
                $user->image    = $row->image;
                $user->b2b      = true;
				$this->user_model->update_login($row->id, true);
				$this->session->set_userdata('user', $user);
                $this->session->set_userdata('b2b', true);
                $this->session->set_userdata('isLogged', true);
                redirect(base_url().index_page().'b2b/index.html');	
			}
		}
        $result = $this->user_model->check_login($email,$password);
		if($result->num_rows()>0) {
			$row = $result->row();
			if($row->publish){
                $user = new stdClass();
                $user->id   = $row->id;
                $user->b2b  = false;
                $this->session->set_userdata('userid', $row->id);
				$this->user_model->update_login($row->id);
				$this->session->set_userdata('user', $user);
                $this->session->set_userdata('b2b', false);
                $this->session->set_userdata('isLogged', true);

                if($this->cart->total_items()>0){
                    redirect(base_url().index_page().'sugarshop/checkout.html');
                }
                else{
				    redirect(base_url().index_page().'user/owner.html');
                }

			} else {
				$this->session->set_flashdata('message', 'Denne konto er ikke aktiveret endnu');
	        	redirect($return);
			}
		}
		else
		{
	        $this->session->set_flashdata('message', 'Beklager, vi genkender ikke email eller adgangskode. Prøv igen');
	        redirect($return);
		}
    }
    
    function logout(){
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('b2b');
        $this->session->unset_userdata('isLogged');
        $this->cart->destroy();
        redirect(base_url().index_page().'index.html');
    }
    
    function fblogin(){
		$base_url=$this->config->item('base_url'); //Read the baseurl from the config.php file
		//get the Facebook appId and app secret from facebook.php which located in config directory for the creating the object for Facebook class
    	$facebook = new Facebook(array(
		'appId'		=>  $this->config->item('appID'), 
		'secret'	=> $this->config->item('appSecret'),
		));
		$user = $facebook->getUser(); // Get the facebook user id 
		if($user){
			try{
				$user_profile = $facebook->api('/me');  //Get the facebook user profile data
                $user = new stdClass();
                foreach ($user_profile as $key => $value) {
                    $user->$key = $value;
                }
                $isOK = $this->user_model->check_registered_user($user->email);
                if($isOK){
                    $this->session->set_flashdata('message', 'Denne e-mail er registreret, skal du logge ind ved denne e-mail eller logge en anden Facebook-konto');
                    redirect(base_url().index_page().'user/login.html');
                } else {
                    $isOK = $this->user_model->check_logged_user($user->email);
                    if($isOK){
                        $isOK = $this->user_model->update_user($user);
                        if($isOK){
                            $user = $this->user_model->load_info_user($user->email);
                        }
                    } else {
                        $isOK = $this->user_model->save_user($user);
                        if($isOK){
                            $user = $this->user_model->load_info_user($user->email);
                        }
                    }
                }
				$params = array('next' => $base_url.'index.php/user/logout');
				$ses_user=array('user'=>$user,
				   'logout' =>$facebook->getLogoutUrl($params)   //generating the logout url for facebook 
				);
                $this->session->set_userdata('userid', $user->id);
		        $this->session->set_userdata($ses_user);
                $this->session->set_userdata('b2b', false);
                $this->session->set_userdata('isLogged', true);
                redirect(base_url().index_page().'index.html');
			} catch(FacebookApiException $e) { print_r($e); exit;
				error_log($e);
				$user = NULL;
			}		
		}	
	}
    
    function forgotpassword(){
		$data['title']='Har du glemt dit password?';
		$data['content']='user/forgot_password';
		$this->load->view('templates',$data,'');
	}
    
    function forgotpasswords(){
		$data['title']='Send email succes';
		$data['content']='user/forgot_password_sent';
		$this->load->view('templates',$data,'');
	}
    
    function forgotten_password_process(){

        $email = $this->input->post('email');
        $result = $this->user_model->check_user($email);
        if(!$result->num_rows()){
            $this->session->set_flashdata('message', 'Denne konto er ikke registreret, skal du kontrollere igen.');
            redirect(base_url().index_page().'user/forgotpassword.html');
        }
        
        if($result->row()->facebook_id){
            $this->session->set_flashdata('message', 'Denne konto er logget af Facebook, kan ikke ændre password på denne hjemmeside.');
            redirect(base_url().index_page().'user/forgotpassword.html');
        }
        
        $verify_code = md5($email.time());
        $isOK = $this->user_model->save_verify_code($email, $verify_code);
        if(!$isOK){
            $this->session->set_flashdata('message', 'Have et system fejl, prøv igen.');
            redirect(base_url().index_page().'user/forgotpassword.html');
        }
        $user = $this->user_model->get_user_from_email($email);
        $link = base_url().index_page().'user/forgot_password_confirm/'.$user->id.'/'.$verify_code;
        
        $data['name'] = $user->name;
        $data['link'] = $link;
        $data['login'] = base_url().index_page().'user/login.html';
        $data['site'] = base_url().index_page().'index.html';
        $isOK = $this->general_model->sendEmail(array($email), "Sugardating.dk - Glemt adgangskode", 'forgot_password', array('data' => $data), 'cuongld0205@gmail.com');
        if($isOK){
            redirect(base_url().index_page().'user/forgotpasswords.html');
        } else {
            $this->session->set_flashdata('message', 'Kan ikke sende e-mail.');
            redirect(base_url().index_page().'user/forgotpassword.html');
        }
    }
    function forgot_password_confirm($user_id, $code) {
        $verify_code = $this->user_model->get_verify_code($user_id);
	    if($code != $verify_code){
            redirect(base_url().index_page().'user/forgotpassworderror.html');
        } else {
            $this->session->set_userdata('id_change', $user_id);
            redirect(base_url().index_page().'user/change_password/');
        }
	}
    
    function forgotpassworderror(){
        $data['title']='Ændring password har været en fejl';
		$data['content']='user/forgot_password_error';
		$this->load->view('templates',$data,'');
    }
    
    function change_password(){
        $data['title']='Ændring password';
		$data['content']='user/change_password';
		$this->load->view('templates',$data,'');
    }
    
    function change_password_process(){
        $pass = $this->input->post('password');
        $user_id = $this->session->userdata('id_change');
        $isOK = $this->user_model->change_password($user_id, $pass);
        if(!$isOK){
            redirect(base_url().index_page().'user/forgotpassworderror.html');
        }
        $this->session->unset_userdata('id_change');
        $this->user_model->delete_verify_code($user_id);
        $data['title']='Skifte adgangskode med succes';
		$data['content']='user/change_password_success';
		$this->load->view('templates',$data,'');
    }
    
    //Owner
    function register(){
		$data['title']='Bliv Sugar medlem og leg med';
		$data['content']='user/register';
		$this->load->view('templates',$data,'');
	}
    
    function register_success(){
        $data['article'] = $this->user_model->load_article(15);
		$data['title']='Tilmeld succes';
		$data['content']='user/register_success';
		$this->load->view('templates',$data,'');
	}
    
    function register_process(){

		$verify_code = $this->user_model->save_add_user();
        if(!$verify_code){
            $this->session->set_flashdata('message', 'Have et system fejl, prøv igen.');
            redirect(base_url().index_page().'user/register.html');
        } else {
			if($this->input->post('member') == 1){
                $email_to = array($this->input->post('email'), get_admin_email(), 'salg@sugardating.dk');
                $data['name'] = $this->input->post('name');
                $data['email'] = $this->input->post('email');
                $data['password'] = $this->input->post('password');
                $data['member'] = "Sølvmedlemskab";
                $data['price'] = 0;
                $data['login'] = base_url().index_page().'user/login.html';
                $data['site'] = base_url().index_page().'index.html';
				$isOK = $this->general_model->sendEmail($email_to, "Sugardating.dk byder dig velkommen som medlem", 'signup', array('data' => $data), '');
                $this->session->set_userdata('password', $this->input->post('password'));
                $this->session->set_userdata('email', $this->input->post('email'));
                redirect(base_url().index_page().'user/register_success.html');
			} else {
                $this->session->set_userdata('password', $this->input->post('password'));
                $this->session->set_userdata('email', $this->input->post('email'));
                $data['user_id'] = $this->user_model->get_user_id($this->input->post('email'));
				$data['title']='Tilmeld kassen';
                $data['content']='user/register_checkout';
                $this->load->view('templates',$data,'');
			}
		}
    }
    
    function upgrade_checkout(){
        $data['user_id'] = getUser()->id;
        $data['title']='Tilmeld kassen';
        $data['content']='user/register_checkout';
        $this->load->view('templates',$data,'');
	}
    
    function register_checkout_success(){
        $user_id = $_GET['id'];
        $user = $this->user_model->get_user_from_id($user_id);
        $this->user_model->upgrade_member($user_id);
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['password'] = $this->session->userdata('password');
        //$this->session->unset_userdata('password');
        $emailto = array($user->email, get_admin_email(), 'salg@sugardating.dk');
        $data['member'] = "Guldmedlemskab";
        $data['price'] = get_config_value('gold_member_fee');
        $data['login'] = base_url().index_page().'user/login.html';
        $data['site'] = base_url().index_page().'index.html';
        if(getUser()){
            redirect(base_url().index_page().'user/owner.html');
        } else {
            $this->general_model->sendEmail($emailto, "Sugardating.dk byder dig velkommen som medlem", 'signup', array('data' => $data), '');
            redirect(base_url().index_page().'user/register_success.html');
        }
    }
    
    function register_checkout_callback(){
        error_log($this->input->post('ordernumber'), 3, "/var/www/clients/client41/web347/web/error.log");
    }
    
    function register_checkout_error(){
		$data['title']='Tilmeld mislykkes';
		$data['content']='user/register_checkout_error';
		$this->load->view('templates',$data,'');
	}
    
    function upgrade(){
		$data['title']='Opgrader';
		$data['content']='user/upgrade';
		$this->load->view('templates',$data,'');
	}
    
    function owner(){
        $this->check_login();
        $data['user'] = getUser();
        $data['photos'] = $this->user_model->load_all_photo(20, 0);
        $data['blogs'] = $this->user_model->load_all_blog(2, 0);
        $data['activities'] = $this->user_model->load_activities();
        $data['title']='Ejer side';
		$data['content']='user/owner';
		$this->load->view('templates',$data,'');
    }
    
    function editstatus(){
        $this->check_login();
        $data['user'] = getUser();
        $data['title']='Rediger status';
		$data['content']='user/edit_status';
		$this->load->view('templates',$data,'');
    }
    
    function save_status(){
        $this->user_model->save_status();
        redirect(base_url().index_page().'user/owner.html');
    }
    
    function editprofile(){
        $this->check_login();
        $data['user'] = getUser();
        $data['title']='Rediger profil';
		$data['content']='user/edit_profile';
		$this->load->view('templates',$data,'');
    }

    function check_gold(){
        $user = getUser();
        if($user->member == 1){
            redirect(base_url().index_page().'user/owner.html');
        }
    }
    
    function update_profile(){
        $this->user_model->update_profile();
        redirect(base_url().index_page().'user/owner.html');
    }
    
    function deactivate(){
        $this->check_login();
        $this->user_model->deactivate();
        redirect(base_url().index_page().'user/owner.html');
    }
    
    function activate(){
        $this->check_login();
        $this->user_model->activate();
        redirect(base_url().index_page().'user/owner.html');
    }
    //End owner
    
    // Blog
    function blog(){
        $this->check_login();
        $config['base_url'] = base_url().index_page().'/user/blog/';
		$config['per_page'] = 5;
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] =$this->user_model->get_total_blog();
		$this->pagination->initialize($config);
		
		$data['blogs'] = $this->user_model->load_all_blog($config['per_page'], $this->uri->segment(3));
		$data['all_link']=$this->pagination->create_links();
						
        $data['title'] = "Bruger blog";
	    $data['content'] = 'user/own_blog_list';
		$this->load->view('templates',$data,'');
    }
    
    function blogdetail($id){
        $this->check_login();
        $blog = $this->user_model->load_blog($id);
        $data['blog'] = $blog[0];
        $data['title'] = $blog[0]->title;
	    $data['content'] = 'user/own_detail_blog';
		$this->load->view('templates',$data,'');
    }
    
    function addblog(){
        $this->check_login();
        $data['title'] = 'Tilføj blog';
	    $data['content'] = 'user/own_add_blog';
		$this->load->view('templates',$data,'');
    }
    
    function add_blog(){
		$this->user_model->add_blog();
        redirect(base_url().index_page().'user/blog.html');
    }
	
	function view_blog($id){
		$blog = $this->user_model->load_blog($id);
        $user = new stdClass;
        $user->id = $blog[0]->user_id;
        $data['user'] = $user;
        
        $data['blog'] = $blog[0];
        $data['title'] = $blog[0]->title.' - Sugar dating';
	    $data['content'] = 'blog/detail';
		$this->load->view('templates',$data,'');
    }
    
    function deleteblog($id){
        $isOK = $this->user_model->check_own($id);
        if(!$isOK){
            $this->session->set_flashdata('message', 'Kan ikke slette denne artikel');
            redirect(base_url().index_page().'user/blog.html');
        }
        $this->user_model->delete_blog($id);
        redirect(base_url().index_page().'user/blog.html');
    }
    
    function editblog($id){
        $this->check_login();
        $isOK = $this->user_model->check_own($id);
        if(!$isOK){
            $this->session->set_flashdata('message', 'Kan ikke redigere denne artikel');
            redirect(base_url().index_page().'user/blog.html');
        }
        
        $blog = $this->user_model->load_blog($id);
        $data['blog'] = $blog[0];
        $data['title'] = 'Redigere blog';
	    $data['content'] = 'user/own_edit_blog';
		$this->load->view('templates',$data,'');
    }
    
    function edit_blog(){
        $id = $this->input->post("id");
        $isOK = $this->user_model->check_own($id);
        if(!$isOK){
            $this->session->set_flashdata('message', 'Kan ikke redigere denne artikel');
            redirect(base_url().index_page().'user/blog.html');
        }
        
        $this->user_model->edit_blog($id);
        redirect(base_url().index_page().'user/blog.html');
    }
    // End blog
    
    //Photo
    function photo(){
        $this->check_login();
        $config['base_url'] = base_url().index_page().'/user/photo.html';
		$config['per_page'] = 30;
		$config['uri_segment'] = 3; 
		
		$config['total_rows'] =$this->user_model->get_total_photo();
		$this->pagination->initialize($config);
		
		$data['photos'] = $this->user_model->load_all_photo($config['per_page'], $this->uri->segment(3));
		$data['all_link']=$this->pagination->create_links();
						
        $data['title'] = "Billeder list";
	    $data['content'] = 'user/own_photo_list';
		$this->load->view('templates',$data,'');
    }

    function addphoto(){
        $this->check_login();
        $data['title'] = "Tilføje billeder";
	    $data['content'] = 'user/own_add_photo';
		$this->load->view('templates',$data,'');
    }
    
    function save_photo(){
        $this->check_login();
        $num = $this->session->userdata('num');
        $this->user_model->save_photo($num);
        $num = $this->session->unset_userdata('num');
		redirect(base_url().index_page().'user/photo.html');
    }
    
    function own_delete_photo($id){
        $isOK = $this->user_model->check_photo_own($id);
        if(!$isOK){
            $this->session->set_flashdata('message', 'Kan ikke slette dette billede');
            redirect(base_url().index_page().'user/photo.html');
        }
        $this->user_model->delete_photo($id);
        redirect(base_url().index_page().'user/photo.html');
    }
    
    //End photo
    
    //Friend
    function request(){
        $this->check_login();
		$data['requests'] = $this->user_model->load_all_request();
						
        $data['title'] = "Venneanmodning";
	    $data['content'] = 'user/friend_request';
		$this->load->view('templates',$data,'');
    }
    
    function accept_request($id){
        $isOK = $this->user_model->accept_request($id);
        if(!$isOK){
            $this->session->set_flashdata('message', 'Kan ikke acceptere, har en systemfejl');
            redirect(base_url().index_page().'user/request.html');
        }
        
        redirect(base_url().index_page().'user/request.html');
    }
    
    function reject_request($id){
        $isOK = $this->user_model->reject_request($id);
        if(!$isOK){
            $this->session->set_flashdata('message', 'Kan ikke afvise, har en systemfejl');
            redirect(base_url().index_page().'user/request.html');
        }
        
        redirect(base_url().index_page().'user/request.html');
    }
    
    function friend(){
        $this->check_login();
		$data['friends'] = $this->user_model->load_all_friends();
						
        $data['title'] = "Mine Kontaktpersoner";
	    $data['content'] = 'user/friend_list';
		$this->load->view('templates',$data,'');
    }
    
    function remove_friend($id){
        $this->check_login();
        $isOK = $this->user_model->check_friend($id);
        if($isOK){
            $this->user_model->remove_friend($id);
            redirect(base_url().index_page().'user/friend.html');
        } else {
            $this->session->set_flashdata('message', 'Kan ikke fjerne denne ven, fordi brugeren ikke behøver at være din ven');
            redirect(base_url().index_page().'user/friend.html');
        }
    }
    //End friend
    /** Start DATING*/
    function datinglist(){
        $this->check_login();
        $config['base_url'] = base_url().index_page().'/user/datinglist.html';
		$config['per_page'] = 10;
		$config['uri_segment'] = 3; 
		$config['total_rows'] = $this->user_model->count_datings();
		$this->pagination->initialize($config);

        $data['datings'] = $this->user_model->get_datings($config['per_page'], $this->uri->segment(3));
        $data['all_link']=$this->pagination->create_links();
        $data['title'] = "Dating liste - Sugar dating";
	    $data['content'] = 'user/dating_list';
		$this->load->view('templates',$data,'');
    }
    
    function sletdating($id){
        $this->check_login();
        //Check voucher of dating (neu voucher chua su dung thi bat lai de co the tao dating khac)
        $check = $this->user_model->checkItemDating($id);
        if($check){
            //Update voucher again.
            $this->user_model->updateVoucher($check->id);
        }
        $this->user_model->sletDating($id);
        $this->user_model->sletDatingApply($id);
        redirect(base_url().index_page().'/user/datinglist.html');
    }
    
    function adddating(){
        $this->check_login();
        $this->check_gold();
        $user = getUser();
        if($user){
            $IDlogin = $user->id;
        }else{
            $IDlogin = "";
        }
        $data['menber'] = $this->user_model->getUserLimit(8, $IDlogin);
        $data['vouchers'] = $this->user_model->get_vouchers();
        $data['help01'] = $this->general_model->get_articleId(19);
        $data['help02'] = $this->general_model->get_articleId(20);
        $data['title'] = "Oprette en dating - Sugar dating";
	    $data['content'] = 'user/create_dating';
		$this->load->view('templates',$data,'');
    }
    
    function searchUser(){
        $name = $this->input->post('name');
        $user = getUser();
        if($user){
            $IDlogin = $user->id;
        }else{
            $IDlogin = "";
        }
        if(is_numeric($name)){
            $data['menber'] = $this->user_model->getUserNameID($name,$IDlogin);
        }
        else{
            $data['menber'] = $this->user_model->getUserName($name,$IDlogin);
        }
        $this->load->view('content/user/ajaxsearchuser',$data,'');
    }
    function addVip(){
        $id = $this->input->post('id');
        $user = $this->user_model->getUserID($id);
        echo "Profilnavn: ".$user->name;
    }
    
    function editdating($id){
        $this->check_login();
        $isOK = $this->user_model->check_dating_owner($id);
        if(!$isOK){
            redirect(base_url().index_page().'user/owner.html');
        }
        $user = getUser();
        if($user){
            $IDlogin = $user->id;
        }else{
            $IDlogin = "";
        }
        $data['menber'] = $this->user_model->getUserLimit(8, $IDlogin);
        $data['dating'] = $this->user_model->get_dating($id);
        $data['vouchers'] = $this->user_model->get_vouchers_id($data['dating']->order_item_id);
        $data['help01'] = $this->general_model->get_articleId(19);
        $data['help02'] = $this->general_model->get_articleId(20);
        $data['title'] = "Redigere dating - Sugar dating";
	    $data['content'] = 'user/edit_dating';
		$this->load->view('templates',$data,'');
    }
    
    function save_dating(){
        $title = $this->input->post('title');
        if($title){
            $isOK = $this->user_model->save_dating();
            if($isOK){
                //LDC Used deal
                $order_item_id = $this->input->post('order_item_id');
                $this->general_model->updateUsed('order_item', $order_item_id);
                //Add activity of user
                $user = getUser();
                $activity['user_id'] = $user->id;
                $activity['type'] = 1;
                $activity['content_id'] = 0;
                $activity['data'] = $title;
                $activity['time'] = time();
                $this->general_model->addActivity($activity);
                /** Vip user, send mail to vip*/
                $vipid = $this->input->post('vipid');
                if($vipid){
                    $user = $this->user_model->getUserID($vipid);
                    $to = $user->email;
                    $configEmail['mailtype'] = 'html';
            	    $this->load->library('email', $configEmail);
            	    $this->email->set_newline("\r\n");
            	    $this->email->initialize($configEmail);
                    $from = "kundeservice@sugardating.dk";
                    $subject = "Du har fået en VIP invitation!";
                    $content = '<!DOCTYPE HTML>
                                <html>
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                <title>Du har fået en VIP invitation!</title>
                                </head>
                                <body style="font-size:100%; color: #000; font: normal 15px  Helvetica, Arial, sans-serif;">
                                    Kære <b>'.$user->name.'</b><br /><br />
                                    En profil på Sugardating.dk synes du er helt speciel, og har sendt dig en <b>VIP invitation</b><br />
                                    Måske er det en invitation til at komme ud at spise i byen<br />
                                    Måske er det en gave fra din ønskeliste<br />
                                    Eller måske noget helt andet....<br /><br />
                                    
                                    <b>NB!</b> VIP invitationer er kun gyldige i et kort tidsrum.<br />
                                    Husk derfor at logge ind på din Sugardating.dk profil, inden din VIP invitation udløber.<br /><br />
                                    
                                    <a href="'.base_url().index_page().'user/login.html">Log ind hér</a><br /><br />
                                    
                                    Med venlig hilsen<br />
                                    Christina<br />
                                    Kundeservice@sugardating.dk<br />
                                    <a href="'.base_url().index_page().'index.html">Sugardating.dk</a>
                                </body>
                                </html>';
                          
                    $this->email->clear();
                    $this->email->to($to);
                    $this->email->from($from,'Christina, Sugardating.dk');
                    $this->email->subject($subject);
                    $this->email->message($content);
                    $this->email->send();
                }
                redirect(base_url().index_page().'user/datinglist.html');
            } else {
                $this->session->set_flashdata('message', 'Kan ikke oprette en dating');
                redirect(base_url().index_page().'user/adddating.html');
            }
        }else{
            $this->session->set_flashdata('message', 'Kan ikke oprette en dating');
            redirect(base_url().index_page().'user/adddating.html');
        }
    }
    
    function update_dating(){
        $isOK = $this->user_model->update_dating();
        /** Vip user, send mail to vip*/
        $vipid = $this->input->post('vipid');
        if($vipid){
            $user = $this->user_model->getUserID($vipid);
            $to = $user->email;
            $configEmail['mailtype'] = 'html';
    	    $this->load->library('email', $configEmail);
    	    $this->email->set_newline("\r\n");
    	    $this->email->initialize($configEmail);
            $from = "kundeservice@sugardating.dk";
            $subject = "Du har fået en VIP invitation!";
            $content = '<!DOCTYPE HTML>
                        <html>
                        <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <title>Du har fået en VIP invitation!</title>
                        </head>
                        <body style="font-size:100%; color: #000; font: normal 15px  Helvetica, Arial, sans-serif;">
                            Kære <b>'.$user->name.'</b><br /><br />
                            En profil på Sugardating.dk synes du er helt speciel, og har sendt dig en <b>VIP invitation</b><br />
                            Måske er det en invitation til at komme ud at spise i byen<br />
                            Måske er det en gave fra din ønskeliste<br />
                            Eller måske noget helt andet....<br /><br />
                            
                            <b>NB!</b> VIP invitationer er kun gyldige i et kort tidsrum.<br />
                            Husk derfor at logge ind på din Sugardating.dk profil, inden din VIP invitation udløber.<br /><br />
                            
                            <a href="'.base_url().index_page().'user/login.html">Log ind hér</a><br /><br />
                            
                            Med venlig hilsen<br />
                            Christina<br />
                            Kundeservice@sugardating.dk<br />
                            <a href="'.base_url().index_page().'index.html">Sugardating.dk</a>
                        </body>
                        </html>';
                  
            $this->email->clear();
            $this->email->to($to);
            $this->email->from($from,'Christina, Sugardating.dk');
            $this->email->subject($subject);
            $this->email->message($content);
            $this->email->send();
        }
        if($isOK){
            redirect(base_url().index_page().'user/datinglist.html');
        } else {
            $this->session->set_flashdata('message', 'Kan ikke oprette en dating');
            redirect(base_url().index_page().'user/adddating.html');
        }
    }
    
    function datingdetail($id){
        $this->check_login();
        $user = getUser();
        $dating = $this->user_model->get_dating($id);
        if($dating->order_item_id){
            $icon = $this->user_model->getIconCategory($dating->order_item_id);
            $white_icon = $icon->white_icon;
        }else{
            $white_icon = '724b7666efdbb68edbf7c7cd9233216c.png';
        }
        $datingApply = $this->user_model->loadDatingApply($id);
        $data['userVip'] = "";
        if($dating->uservip){
            $userVip = $this->user_model->getUserID($dating->uservip);
            $data['userVip'] = $userVip;
        }
        $data['user'] = $user;
        $data['dating'] = $dating;
        $data['datingIcon'] = $white_icon;
        $data['datingapply'] = $datingApply;
        $data['title'] = "Dating detalje - Sugar dating";
	    $data['content'] = 'user/dating_detail';
		$this->load->view('templates',$data,'');
    }
    
    function acceptDating(){
        $dating_id = $this->input->post('dating');
        $user_id = $this->input->post('user');
        //Update OK apply dating
        $OK = $this->user_model->updateDatingApply($dating_id,$user_id);
        if($OK){
            //Denial all left other dating
            $this->user_model->denialDatingApply($dating_id,0);
            $this->user_model->updateDating($dating_id);
        }
        $datingApply = $this->user_model->loadDatingApply($dating_id);
        $data['datingapply'] = $datingApply;
        $this->load->view('content/user/dating_apply',$data,'');
    }
    
    function dating(){
        $this->check_login();
        $user = getUser();
        $dating = $this->user_model->loadDatingApplyUser($user->id);
        $datings = "";
        if($dating){
            foreach($dating as $rows){
                if($rows->order_item_id){
                    $icon = $this->user_model->getIconCategory($rows->order_item_id);
                    $white_icon = $icon->white_icon;
                    $dealName = $icon->name;
                    $dealID = $icon->id;
                }else{
                    $white_icon = '724b7666efdbb68edbf7c7cd9233216c.png';
                    $dealName = "Ingen deal";
                    $dealID = "";
                }
                $datings[] = array(
                    'applyid' => $rows->applyid,
                    'id' => $rows->id,
                    'title' => $rows->title,
                    'alias' => $rows->alias,
                    'end_date' => $rows->end_date,
                    'description' => $rows->description,
                    'white_icon' => $white_icon,
                    'dealName' => $dealName,
                    'dealID' => $dealID,
                    'status' => $rows->status,
                    'userid' => $rows->user_id,
                    'name' => $rows->name,
                    'gender' => $rows->gender,
                    'avatar' => $rows->avatar,
                    );
            }
        }
        $data['datings'] = $datings;
        $data['title'] = "Du skal med på date! - Sugar dating";
	    $data['content'] = 'user/dating_anmodning';
		$this->load->view('templates',$data,'');
    }
    
    function datingvip(){
        $this->check_login();
        $user = getUser();
        $dating = $this->user_model->loadDatingApplyVip($user->id);
        $datings = "";
        if($dating){
            foreach($dating as $rows){
                if($rows->order_item_id){
                    $icon = $this->user_model->getIconCategory($rows->order_item_id);
                    if($icon){
                        $white_icon = $icon->white_icon;
                        $dealName = $icon->name;
                        $dealID = $icon->id;
                    }
                    else{
                        $white_icon = '724b7666efdbb68edbf7c7cd9233216c.png';
                        $dealName = "Ingen deal";
                        $dealID = "";
                    }
                }else{
                    $white_icon = '724b7666efdbb68edbf7c7cd9233216c.png';
                    $dealName = "Ingen deal";
                    $dealID = "";
                }
                $datings[] = array(
                    'id' => $rows->id,
                    'title' => $rows->title,
                    'alias' => $rows->alias,
                    'end_date' => $rows->end_date,
                    'description' => $rows->description,
                    'white_icon' => $white_icon,
                    'dealName' => $dealName,
                    'dealID' => $dealID,
                    'publish' => $rows->publish,
                    'used' => $rows->used,
                    'userid' => $rows->user_id,
                    'name' => $rows->name,
                    'gender' => $rows->gender,
                    'avatar' => $rows->avatar,
                    );
            }
        }
        $data['datings'] = $datings;
        $data['title'] = "VIP Invitation - Sugar dating";
	    $data['content'] = 'user/dating_vip';
		$this->load->view('templates',$data,'');
    }
    
    function sletapply($id){
        $this->user_model->deleteDatingApply($id);
        redirect(base_url().index_page().'user/dating.html');
    }
    function toapply($id,$type){
        $this->user_model->toDatingApply($id,$type);
        redirect(base_url().index_page().'user/datingvip.html');
    }
    function sletvip($id){
        $this->user_model->deleteVip($id);
        redirect(base_url().index_page().'user/datingvip.html');
    }
    /** The End DATING*/
    
    function check_login(){
        $user = $this->session->userdata('user');
        if(!$user){
            $this->session->set_flashdata('message', 'Log venligst på igen');
            redirect(base_url().index_page().'user/login.html');
        }
    }
    //Ajax function
    function ajaxUpdateAvatar(){
        $user = getUser();
        if($_FILES['avatar']['name']){
			$image = $this->user_model->load_avatar_name($user->id);
			$config['upload_path'] = get_config_value('upload_avatar_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= get_config_value('max_size');
			$config['encrypt_name']	= TRUE;    // rename to random string
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('avatar')){	
				$datax = $this->upload->data();
                $data['avatar'] = $datax['file_name'];
			} else {
                $data['avatar'] = "";
			}
            //Update user profile avatar
            if($data['avatar']){
                $this->user_model->updateProfile($user->id, $data);
            }
            if($data['avatar']&&$image){
                unlink('upload/user/'.$image);
            }
		}
        $data['image'] = $this->user_model->load_avatar_name($user->id);
        $this->load->view('content/user/ajaxavatar',$data,'');
    }
    
    function ajax_check_email(){
        $email = $this->input->post('email');
        $isOK = $this->user_model->check_registered_user($email);
        if($isOK){
            echo json_encode(array('html' => '<span style="color:#F00">E-mail er allerede registeret.</span>', 'accept' => 0, TRUE));
        } else {
            echo json_encode(array('html' => '&nbsp;', 'accept' => 1, TRUE));
        }
        exit;
    }
    
    function ajax_save_photo(){
        $user = getUser();
		$isOK = $this->user_model->add_photo($user->id);
        $num = $this->session->userdata('num')?$this->session->userdata('num'):0;
		if($isOK){
            $num++;
            $this->session->set_userdata('num', $num);
			echo '{"status":"success"}';
			exit;
		} else {
			echo '{"status":"error"}';
			exit;
		}
    }
    
    function ajax_load_more_activity(){
        $offset = $this->input->post('offset');
        $html = $this->user_model->ajax_load_more_activity($offset);
        echo $html;
        exit;
    }
    
    function ajax_load_postcode(){
        $code = $this->input->post('code');
        $city = $this->user_model->ajax_load_postcode($code);
        if($city){
            echo $city->city;
        }
        else{
            echo "";
        }
        exit;
    }
}
?>