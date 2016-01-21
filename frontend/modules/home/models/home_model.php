<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Home_Model extends MX_Controller { 
    public function __construct() {
        parent::__construct(); 
    }
    function get_users(){
        $user = getUser();
        /*
        if($user){
            $this->db->where('id !=', $user->id);
        }*/
        $this->db->select('*');
        $this->db->where('member', 2);
        $this->db->where('active', 1);
        $this->db->where('publish', 1);
        $this->db->order_by('RAND()');
        $this->db->limit(150, 0);
        $result = $this->db->get('user');
        return $result;
    }
    function get_blogs(){
        $user = getUser();
        /*
        if($user){
            $this->db->where('b.user_id !=', $user->id);
        }*/
        $this->db->select('u.hide_avatar, u.avatar, u.facebook_id, u.name, u.gender, u.id AS user_id, u.own, u.member, b.id AS blog_id, b.content, b.time, b.alias');
        $this->db->from('user u');
        $this->db->join('blog b', 'u.id = b.user_id');
        $this->db->where('u.active', 1);
        $this->db->where('b.publish', 1);
        $this->db->order_by('b.time DESC');
        $this->db->limit(150, 0);
        $result = $this->db->get();
        return $result;
    }
}