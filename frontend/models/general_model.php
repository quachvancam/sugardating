<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class General_Model extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    function sendEmail($emails, $subject, $templateName, $data = array(), $from = null, $mailType = 'html')
	{
	   	$configEmail['mailtype'] = $mailType;     
        /*$configEmail['protocol'] = 'smtp';
        $configEmail['smtp_host'] = 'smtp.gmail.com';
        $configEmail['smtp_user'] = 'cuongld0205@gmail.com';
        $configEmail['smtp_pass'] = '0976465090';
        $configEmail['smtp_port'] = 465;
        $configEmail['smtp_crypto'] = 'ssl';*/
        
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
                    $this->email->from('kundeservice@sugardating.dk','Christina, Sugardating.dk');
                }
                else{
                    $this->email->from($from,'Christina, Sugardating.dk');
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
	function get_articleId($id = null){
        $this->db->from('article');
    	$this->db->select('*');
		$this->db->where('id', $id);
    	$result = $this->db->get();
	    return $result->result();
	}
    function get_articleIdCategory($id = null){
        $this->db->from('article');
    	$this->db->select('*');
		$this->db->where('category_id', $id);
        $this->db->where('publish', 1);
        $this->db->order_by('ordering', 'desc');
    	$result = $this->db->get();
	    return $result->result();
	}
    function updateUsed($table=NULL, $id=NULL){
        $this->db->set('used', 1);
        $this->db->where('id', $id);
		$result = $this->db->update($table);
		return $result;
    }
    function getDatingVip(){
        $this->db->select('*');
        $this->db->from('dating');
        $this->db->where('timevip >', 0);
        $this->db->where('publish', 0);
        $this->db->where('used', 0);
    	$result = $this->db->get();
	    return $result->result();
    }
    function huyVip($id=NULL){
        $this->db->set('publish', 1);
        $this->db->set('uservip', "");
        $this->db->set('timevip', 0);
        $this->db->where('id', $id);
		$result = $this->db->update('dating');
		return $result;
    }
    function getuserGold(){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('member', 2);
        $this->db->where('publish', 1);
        $this->db->where('active', 1);
        $this->db->where('payment_time >', 0);
    	$result = $this->db->get();
	    return $result->result();
    }
    function huyGold($id=NULL){
        $this->db->set('member', 1);
        $this->db->where('id', $id);
		$result = $this->db->update('user');
		return $result;
    }
    function addActivity($data=NULL){
	$this->db->insert('activity', $data);
    }
    
 	function get_slide()
	{
        $this->db->from('slideshow');
    	$this->db->select('*');
    	$result = $this->db->get();
	    return $result->result();
    }
}