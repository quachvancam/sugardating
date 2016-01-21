<?php
#Check uft-8 Cường
class Start extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('general_model');
        $this->load->model('sugarshop_model');
        $this->check24hVip();
        $this->checkuserGold();
        session_start();
    }
	function index(){
        if ($this->session->userdata('b2b') == TRUE) {
			redirect(base_url().index_page().'b2b/index.html');
	    } else {
			$data['title']='Start - Sugardating.dk';
            $data['content']='home';
            $this->load->view('templates',$data,'');
		}
	}
    function check24hVip(){
        $datingVip = $this->general_model->getDatingVip();
        if($datingVip){
            foreach($datingVip as $rows){
                $time = time() - $rows->timevip;
                $h = $time/60/60;
                if(intval($h)>24){
                    //Sau 24h huy VIP doi voi user khong co hanh dong gi
                    $this->general_model->huyVip($rows->id);
                }
            }
        }
    }
    function checkuserGold(){
        $userGold = $this->general_model->getuserGold();
        if($userGold){
            foreach($userGold as $rows){
                $time = strtotime("+1 month", $rows->payment_time);
                if(time()>$time){
                    //Sau 1 thang huy Gold doi voi user
                    $this->general_model->huyGold($rows->id);
                }
            }
        }
    }
    function message(){
        $data['title']='Kvittering';
		$data['content']='message';
		$this->load->view('templates',$data,'');
    }
    function faq(){
        $info = $this->general_model->get_articleId(7);
        $data['info1'] = $info[0]->short_content;
        $data['info2'] = $info[0]->full_content;
        $data['title'] = $info[0]->title;
        $info = $this->general_model->get_articleIdCategory(2);
        $data['info'] = $info;
		$data['content']='faq';
		$this->load->view('templates',$data,'');
	}
    function help(){
        $data['title']='Hjælp';
		$data['content']='help';
		$this->load->view('templates',$data,'');
    }
    function helpSend(){
        $data['name'] = $this->input->post('name', true);
        $data['email'] = $this->input->post('email', true);
        $data['login'] = base_url().index_page().'user/login.html';
        $data['site'] = base_url().index_page().'index.html';
        $data['besked'] = nl2br(strip_tags(html_entity_decode($this->input->post('besked', true), ENT_QUOTES, 'UTF-8')));
        if($this->input->post('captcha', true)!=$_SESSION["captchaCode"]){
			$this->session->set_flashdata('error',"Forkert sikkerhedskode, skal du udfylde igen");
        	redirect(base_url().index_page()."help.html");
		}
		else{
            $adminMail = array("nguyen.cuong@mwc.vn, kundeservice@sugardating.dk");
            $this->general_model->sendEmail($adminMail, 'Sugardating.dk takker for dit spørgsmål', 'help', array('data'=>$data),'');
			$this->session->set_flashdata('message',"Tak for dit spørgsmål. Jeg vender hurtigst muligt tilbage til dig.<br/> Så hold øje med din indbakke. Der er en mail på vej.<br/> Det er det hele værd. Du er det hele værd!");
			redirect(base_url().index_page()."message.html");
		}
    }
    function kontakt(){
        $data['title']='Kontakt';
		$data['content']='kontakt';
		$this->load->view('templates',$data,'');
    }
    function kontaktSend(){
        $data['name'] = $this->input->post('name', true);
        $data['email'] = $this->input->post('email', true);
        $data['besked'] = nl2br(strip_tags(html_entity_decode($this->input->post('besked', true), ENT_QUOTES, 'UTF-8')));
        $data['login'] = base_url().index_page().'user/login.html';
        $data['site'] = base_url().index_page().'index.html';
        if($this->input->post('captcha', true)!=$_SESSION["captchaCode"]){
			$this->session->set_flashdata('error',"Forkert sikkerhedskode, skal du udfylde igen");
        	redirect(base_url().index_page()."kontakt.html");
		}
		else{
            $adminMail = array("nguyen.cuong@mwc.vn, kundeservice@sugardating.dk");
            $this->general_model->sendEmail($adminMail, 'Sugardating.dk takker for din henvendelse', 'kontakt', array('data'=>$data),'');
			$this->session->set_flashdata('message',"Tak for din henvendelse. Jeg vender hurtigst muligt tilbage til dig.<br/> Så hold øje med din indbakke. Der er en mail på vej.<br/> Det er det hele værd. Du er det hele værd!");
			redirect(base_url().index_page()."message.html");
		}
    }
    function medlemsbetingelser($redirect=NULL){
        $info = $this->general_model->get_articleId(5);
        if($redirect == "shop"){
            $link = base_url().index_page()."sugarshop/checkout.html";
        }
        elseif($redirect == "user"){
            $link = base_url().index_page()."user/register.html";
        }
        else{
            $link = base_url().index_page()."index.html";
        }
        $data['redirect'] = $redirect;
        $data['info'] = $info[0]->full_content;
        $data['title'] = $info[0]->title;
		$data['content'] = 'medlemsbetingelser';
		$this->load->view('templates',$data,'');
    }
    function sikkerhed(){
        $info = $this->general_model->get_articleId(6);
        $data['info'] = $info[0]->full_content;
        $data['title'] = $info[0]->title;
		$data['content']='sikkerhed';
		$this->load->view('templates',$data,'');
    }
    
    function medlemskab(){
        $info = $this->general_model->get_articleId(16);
        $data['info'] = $info[0]->full_content;
        $data['title'] = $info[0]->title;
		$data['content']='medlemskab';
		$this->load->view('templates',$data,'');
    }
}
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */