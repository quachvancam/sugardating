<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class User_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function check_login($email,$pass){
		$this->db->like('email', $email);
		$this->db->like('password', $pass); 
		$query = $this->db->get('admin');
		return $query;
	}
	
	function update_login($userid){
		$data['last_login'] = time();
		$this->db->where('id',$userid);
		$result = $this->db->update('admin',$data);
		return $result ? 1 : 0;
	}
	
	function load_all_user($num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('user');
		$result = $this->db->get();		

		return $result->result();
	}
	
	function load_user($id){
		$this->db->where('id', $id);
		$user = $this->db->get('user');
		return $user->row();
	}
	
	function get_all(){
		$result = $this->db->count_all('user');
		return $result;
	}
	
	function check_user($email){
		$this->db->select('id');
		$this->db->where('email', $email);
		$result = $this->db->get('user');
		return $result->row();
	}
	
	function add_user(){

		$config['upload_path'] = get_config_value('upload_avatar_path');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= get_config_value('max_size');
		$config['encrypt_name']	= TRUE;    // rename to random string

		if($_FILES['avatar']['name']){
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('avatar')){	
				$datax = $this->upload->data();
			} else {
				return false;
			}
		} else {
			$datax['file_name'] = NULL;				
		}

		$this->db->set('email', 	$this->input->post('email'));
		$this->db->set('password', 	md5($this->input->post('pass')));
		$this->db->set('name', 		$this->input->post('name'));
		$this->db->set('gender', 	$this->input->post('gender'));
		$this->db->set('day', 		$this->input->post('day'));
		$this->db->set('month',		$this->input->post('month'));
		$this->db->set('year', 		$this->input->post('year'));
		$this->db->set('height', 	$this->input->post('height'));
		$this->db->set('weight',	$this->input->post('weight'));
		$this->db->set('code', 		$this->input->post('code'));
		$this->db->set('city', 		$this->input->post('city'));
		$this->db->set('own', 		$this->input->post('own'));
		$this->db->set('play', 		$this->input->post('play'));
		$this->db->set('member',	$this->input->post('member'));
        if($this->input->post('member')==2){
            $this->db->set('payment_time',	time());
        }
		$this->db->set('facebook_id', 		0);
		$this->db->set('avatar',	$datax['file_name']);
		$this->db->set('register_time',	time());
		$this->db->set('verify_code', md5(time().$this->input->post('email')));
		$this->db->set('status',	$this->input->post('status'));
		$this->db->set('status_permission',	$this->input->post('status_permission'));
        $this->db->set('slogan',	$this->input->post('slogan'));
		$this->db->set('description',	$this->input->post('description'));
        $this->db->set('see_profile',	$this->input->post('see_profile'));
        $this->db->set('active',	1);
		$this->db->set('publish',	1);
		
		$result = $this->db->insert('user');
		return $result;
	}
	
	function update_user(){
		if($_FILES['avatar']['name']){
			$image = $this->load_avatar_name($this->input->post('id'));
			unlink('upload/user/'.$image);
			
			$config['upload_path'] = get_config_value('upload_avatar_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= get_config_value('max_size');
			$config['encrypt_name']	= TRUE;    // rename to random string
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('avatar')){	
				$datax = $this->upload->data();
				$this->db->set('avatar',	$datax['file_name']);
			} else {
				return false;
			}
		} 
		
		$this->db->set('email', 	$this->input->post('email'));
		if($this->input->post('pass')){
			$this->db->set('password', 	md5($this->input->post('pass')));
		}
		$this->db->set('name', 		$this->input->post('name'));
		$this->db->set('gender', 	$this->input->post('gender'));
		$this->db->set('day', 		$this->input->post('day'));
		$this->db->set('month',		$this->input->post('month'));
		$this->db->set('year', 		$this->input->post('year'));
		$this->db->set('height', 	$this->input->post('height'));
		$this->db->set('weight',	$this->input->post('weight'));
		$this->db->set('code', 		$this->input->post('code'));
		$this->db->set('city', 		$this->input->post('city'));
		$this->db->set('own', 		$this->input->post('own'));
		$this->db->set('play', 		$this->input->post('play'));
		$this->db->set('member',	$this->input->post('member'));
        if($this->input->post('member')==2){
            $this->db->set('payment_time',	time());
        }
		$this->db->set('status',	$this->input->post('status'));
		$this->db->set('status_permission',	$this->input->post('status_permission'));
        $this->db->set('slogan',	$this->input->post('slogan'));
		$this->db->set('description',	$this->input->post('description'));
        $this->db->set('see_profile',	$this->input->post('see_profile'));
		
		$this->db->where('id', $this->input->post('id'));
		
		$result = $this->db->update('user');
		return $result;
	}
	
	function load_avatar_name($id){
		$this->db->select('avatar');
		$this->db->where('id', $id);
		$result = $this->db->get('user');
		return $result->row()->avatar;
	}
    
    function load_search_user($num, $offset, $kw){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('user');
        $this->db->like('name', $kw);
		$result = $this->db->get();		

		return $result->result();
	}
	
	function get_search_all($kw){
        $this->db->like('name', $kw);
		$result = $this->db->count_all('user');
		return $result;
	}
    
    function delete_user($id){
        $image = $this->load_avatar_name($id);
        unlink('upload/user/'.$image);
        
		$query = "DELETE FROM user WHERE id = ".$id;
		$result = $this->db->query($query);
		return $result;
	}
    
    function delete_avatar($id){
        $image = $this->load_avatar_name($id); 
        unlink('upload/user/'.$image);
        
        $this->db->set('avatar', '');
        $this->db->where('id', $id);
		$result = $this->db->update('user');
		return $result;
    }
}