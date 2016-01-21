<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class B2b_User_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function sendEmail($emails, $subject, $templateName, $data = array(), $from = null, $mailType = 'html')
	{
	   	$configEmail['mailtype'] = $mailType;
	    $this->load->library('email', $configEmail);
	    $this->email->set_newline("\r\n");
	    $this->email->initialize($configEmail);
	    /** Load email template from database */
	    $result = $this->db->get_where('mail_template', array('title'=> $templateName, 'publish'=> 1));
	    $result = $result->result_array();
	    if (empty($result)){
	        return false;
	    }
	    $content = $result[0];
        extract($data);
        ob_start();
	    echo eval ('?>'.$content['content']);
	    $content = ob_get_contents();
	    @ob_end_clean();
	    /** Send mail */
        try {
            foreach($emails as $email){
                $this->email->clear();
                $this->email->to($email);
                if($from == NULL ){
                    $this->email->from('kundeservice@sugardating.dk');
                }
                else{
                    $this->email->from($from);
                }
                $this->email->subject($subject);
                $this->email->message($content);
                $this->email->send();
            }
	    } catch (Exception $e){
            return false;
	    }
        return true;
	}
	function load_all_b2b($num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('b2b_user');
		$result = $this->db->get();		

		return $result->result();
	}
	
	function load_b2b($id){
		$query = "SELECT * FROM b2b_user WHERE id = ".$id;
		$user = $this->db->query($query);
		return $user->row();
	}
	
	function update_b2b($data){
        if($_FILES['image']['name']){
			$image = $this->load_image_name($this->input->post('id'));
			unlink('upload/b2b/'.$image);
			$config['upload_path'] = get_config_value('upload_b2b_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= get_config_value('max_size');
			$config['encrypt_name']	= TRUE;    // rename to random string
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('image')){
				$datax = $this->upload->data();
				$this->db->set('image',	$datax['file_name']);
			} else {
				print_r($this->upload->display_errors());exit;
			}
		}
		if($data['new_pass']){
            $this->db->set('password', md5($data['new_pass']));
		}
        $this->db->set('name', $data['name']);
        $this->db->set('web', $data['web']);
        $this->db->set('company', $data['company']);
        $this->db->where('id', $data['id']);
		$result = $this->db->update('b2b_user');
		return $result;
	}
	
	function add_b2b($data){
        $result = $this->db->insert('b2b_user',$data);
		return $result;
	}
	
	function update_status($table, $id, $status){
		$query = "UPDATE ".$table." SET publish = ".$status." WHERE id = ".$id;
		$result = $this->db->query($query);
		return $result;
	}
	
	function delete_b2b($id){
		$query = "DELETE FROM b2b_user WHERE id = ".$id;
		$result = $this->db->query($query);
		return $result;
	}
	
	function check_b2b($email){
		$query = "SELECT id FROM b2b_user WHERE email = '".$email."'";
		$user = $this->db->query($query);
		return $user->row();
	}
	
	function load_search_b2b($num, $offset, $kw){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('b2b_user');
        $this->db->like('name', $kw);
		$result = $this->db->get();		

		return $result->result();
	}
	
	function get_all(){
		$result = $this->db->count_all('b2b_user');
		return $result;
	}
    
    function get_search_all($kw){
        $this->db->like('name', $kw);
		$result = $this->db->count_all('b2b_user');
		return $result;
	}
    
    function load_image_name($id){
		$this->db->select('image');
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->get('b2b_user');
		return $result->row()->image;
	}
}