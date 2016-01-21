<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');
    }

	function index()
	{
	    if ($this->session->userdata('adminStatus') == TRUE)
	    {
			redirect(base_url().index_page().'cpanel/');
	    }
		else
		{
			$this->load->view('login');
		}
	}
	function login()
	{
		$email = $this->security->xss_clean($this->input->post('email'));    
	    $password = md5($this->input->post('password'));
		$result = $this->user_model->check_login($email,$password);
		if($result->num_rows()>0) {
			$row = $result->row();
			if($row->publish){
				$data = array(
				   'email'          => $email,
				   'id'             => $row->id,
                   'name'           => $row->name,
				   'adminStatus'   => true
				);
				$this->user_model->update_login($row->id);
				$this->session->set_userdata($data);
				redirect(base_url().index_page().'cpanel/');
			} else {
				$this->session->set_flashdata('message', 'Denne konto er ikke aktiveret endnu');
	        	redirect(base_url().index_page().'admin/');
			}
		}
		else
		{
	        $this->session->set_flashdata('message', 'Beklager, vi genkender ikke email eller adgangskode. Prøv igen');
	        redirect(base_url().index_page().'admin/');
		}
    }
	function checkpass($pass='')// ajax
	{	
		if ($pass!='')
		{
			$result=$this->session->userdata('password')<>md5($pass)?0:1;
			if ($result)
			{
				//echo "<img src='".base_url()."/assets/img/checked.gif' align='absmiddle'/> ".$this->lang->line('f_right_password').'<input type="hidden" id="correctpass" value=1 />';
				echo '<span class="input-notification success png_bg">'.$this->lang->line('f_right_password').'</span>'.'<input type="hidden" id="correctpass" value=1 />';
			}
			else
			{
				echo '<span class="input-notification error png_bg">'.$this->lang->line('f_wrong_password').'</span>'.'<input type="hidden" id="correctpass" value=0 />';
			}
		}
	}

	function logout()
	{
		$this->session->unset_userdata('adminStatus');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('name');
	    redirect(base_url().index_page().'admin/');
	}
}
?>