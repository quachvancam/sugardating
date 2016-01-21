<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Profiles_Model extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function load_photo_from_id($id, $num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('gallery');
        $this->db->where('user_id', $id);
        $this->db->order_by('time DESC');
		$result = $this->db->get();		

		return $result->result();
	}
    
    function load_user_from_id($id){
        $this->db->select('*');
		$this->db->where('id', $id);
		$result = $this->db->get('user');
		return $result->row();
    }
    
    function load_name_from_id($id){
        $this->db->select('name');
		$this->db->where('id', $id);
		$result = $this->db->get('user');
		return $result->row();
    }
    
    function load_blog_from_id($id, $num, $offset){
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('blog');
        $this->db->where('user_id', $id);
        $this->db->order_by('time DESC');
		$result = $this->db->get();		

		return $result->result();
	}
    
    function clear_not_seen($from_id){
        $to_id = getUser()->id;
        $this->db->set('seen',	1);
        $this->db->where('from_id',	$from_id);
        $this->db->where('to_id',	    $to_id);
		
		$result = $this->db->update('messages');
    }
    
    function ajax_load_more_messages($to_id, $offset){
        $from_id = getUser()->id;
        
        $this->db->limit(10, $offset);
		$this->db->select('m.*, u.name');
		$this->db->from('messages m');
        $this->db->join('user u', 'm.from_id = u.id');
        $this->db->where('(m.from_id='.$from_id.' AND m.to_id='.$to_id.') OR (m.from_id='.$to_id.' AND m.to_id='.$from_id.')');
        $this->db->order_by('m.time DESC');
		$result = $this->db->get();
        $html = '';
        if($result->num_rows()){
            foreach($result->result() as $message){
                if(!$message->attach_dating){
                    if($message->from_id == getUser()->id) $class = 'dark'; else $class = 'light';
                    $html .= '
                    <div class="comItem '.$class.' clearfix">
                        <div class="f-l" style="width:100px;">
                            <p>'.$message->name.'</p>
                            <span>'.get_time_difference_php($message->time).'</span> </div>
                        <div class="f-r w380">
                            <p>'.$message->message.'</p>
                        </div>
                    </div>
                    ';
                } else {
                }
            }
        }
        
        return $html;
    }
    
    function load_messages($to_id, $num, $offset){
        $from_id = getUser()->id;
        
        $this->db->limit($num, $offset);
		$this->db->select('m.*, u.name');
		$this->db->from('messages m');
        $this->db->join('user u', 'm.from_id = u.id');
        $this->db->where('(m.from_id='.$from_id.' AND m.to_id='.$to_id.') OR (m.from_id='.$to_id.' AND m.to_id='.$from_id.')');
        $this->db->order_by('m.time DESC');
		$result = $this->db->get();
        
        return $result->result();
    }
    
    function save_message($message, $from_id, $to_id, $attach_dating){
        if($attach_dating){
            $this->db->set('attach_dating',	$attach_dating);
            $this->db->set('accept',	0);
        }
        $this->db->set('message',	$message);
        $this->db->set('from_id',	$from_id);
        $this->db->set('to_id',	    $to_id);
        $this->db->set('seen',	    0);
		$this->db->set('time',		time());
		
		$result = $this->db->insert('messages');
        return time();
    }
    function delete_message_FT($userid=NULL,$id=NULL){
        $this->db->where('from_id', $userid);
        $this->db->where('to_id', $id);
        $this->db->delete('messages');
    }
    function delete_message_TF($userid=NULL,$id=NULL){
        $this->db->where('to_id', $userid);
        $this->db->where('from_id', $id);
        $this->db->delete('messages');
    }
    
    function load_users(){
        $to_id = getUser()->id;
        $this->db->select('DISTINCT(from_id)');
        $this->db->from('messages');
        $this->db->where('to_id', $to_id);
        $this->db->order_by('time DESC');
        $result = $this->db->get();
        
        $users = "";
        $i=0;
        if($result->result()){
            foreach($result->result() as $item){
                $userSend = $this->load_user_from_id($item->from_id);
                if($userSend){
                    $users[$i] = $userSend;
                    $users[$i]->not_seen = $this->get_not_seen($item->from_id, $to_id);
                    $latest_message = $this->get_latest_message($item->from_id, $to_id);
                    $users[$i]->message = $latest_message->message;
                    $users[$i]->message_time = $latest_message->time;
                    $i++;
                }
                
            }
        }
        return $users;
    }
    
    function get_not_seen($from_id, $to_id){
        $this->db->select('COUNT(*) num');
        $this->db->from('messages');
        $this->db->where('from_id', $from_id);
        $this->db->where('to_id', $to_id);
        $this->db->where('seen', 0);
        $result = $this->db->get();
        return $result->row()->num;
    }
    
    function get_latest_message($from_id, $to_id){
        $this->db->limit(1, 0);
        $this->db->select('message, time');
        $this->db->from('messages');
        $this->db->where('from_id', $from_id);
        $this->db->where('to_id', $to_id);
        $this->db->order_by('time DESC');
        $result = $this->db->get();
        return $result->row();
    }
    
    function send_request($from_id, $to_id){
        $this->db->set('from_id',	$from_id);
        $this->db->set('to_id',	    $to_id);
		$this->db->set('time',		time());
		
		$result = $this->db->insert('friend_request');
        return $result;        
    }
    
    function check_request($from_id, $to_id){
        $this->db->select('id');
        $this->db->from('friend_request');
        $this->db->where('from_id',	$from_id);
        $this->db->where('to_id', $to_id);
		
		$result = $this->db->get();
        return $result->num_rows();
    }
    
    function load_sugars($id, $limit, $page, $min_old, $max_old, $min_height, $max_height, $min_weight, $max_weight, $min_code, $max_code){
        $max_year = date("Y", time()) - $min_old;
        $min_year = date("Y", time()) - $max_old;
        
        $this->db->limit($limit, $limit*$page);
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('own',	$id);
        $this->db->where('active', 1);
        if($min_old && $max_old){
            $this->db->where('year >=', $min_year);
            $this->db->where('year <=', $max_year);
        }
        if($min_height & $max_height && $min_height > 0){
            $this->db->where('height >=', $min_height);
            $this->db->where('height <=', $max_height);
        }
		
        if($min_weight & $max_weight && $min_weight > 0){
            $this->db->where('weight >=', $min_weight);
            $this->db->where('weight <=', $max_weight);
        }
        
        if($min_code & $max_code && $min_code > 0){
            $this->db->where('code >=', $min_code);
            $this->db->where('code <=', $max_code);   
        }
        $this->db->order_by('id DESC');
		$result = $this->db->get();
        return $result->result();
    }
    
    function count_sugars($id, $min_old, $max_old, $min_height, $max_height, $min_weight, $max_weight, $min_code, $max_code){
        $max_year = date("Y", time()) - $min_old;
        $min_year = date("Y", time()) - $max_old;
        
        $this->db->where('own',	$id);
        $this->db->where('active',	1);
        if($min_old && $max_old){
            $this->db->where('year <=', $max_year);
            $this->db->where('year >=', $min_year);
        }
        
        if($min_height && $max_height && $min_height > 0){
            $this->db->where('height <=', $max_height);
            $this->db->where('height >=', $min_height);
        }
		
        if($min_weight && $max_weight && $min_weight > 0){
            $this->db->where('weight <=', $max_weight);
            $this->db->where('weight >=', $min_weight);
        }
        
        if($min_code && $max_code && $min_code > 0){
            $this->db->where('code <=', $max_code);
            $this->db->where('code >=', $min_code);
        }
        $result = $this->db->count_all_results('user');
		return $result;
    }
    
    function load_categories(){
		$this->db->select("id, name");
        $this->db->where("publish", 1);
        $this->db->order_by('ordering');
		$result = $this->db->get('deal_category');
		return $result->result();
	}
    function load_icon_category($id=NULL){
        $this->db->select("dc.white_icon");
        $this->db->from('dating d');
        $this->db->join('order_item oi', 'd.order_item_id = oi.id');
        $this->db->join('deal_category dc', 'dc.id = oi.category_id');
        $this->db->where("d.order_item_id", $id);
        $result = $this->db->get();
		return $result->row();
    }
    function load_datings1($limit=NULL, $page=NULL, $own=NULL, $play=NULL){
        $this->db->limit($limit, $limit*$page);
		$this->db->select("u.id, u.gender, u.hide_avatar, u.avatar, u.name, u.day, u.month, u.year, u.height, u.weight, u.code, u.city, u.own, u.play, d.user_id, d.id  dating_id, d.title, d.alias, d.end_date, d.description, d.order_item_id");
        $this->db->from('dating d');
        $this->db->join('user u', 'd.user_id = u.id');
        $this->db->where("d.publish", 1);
        $this->db->where("d.used", 0);
        $this->db->where("u.active", 1);
        $this->db->where("d.end_date >", time());
        if($own){
            $this->db->where("u.own", $own);
        }
        if($play){
            $this->db->where("u.play", $play);
        }
        $this->db->order_by('d.id DESC');
		$result = $this->db->get();
		return $result->result();
	}

    function count_datings1($own=NULL, $play=NULL){
        $this->db->join('user u', 'd.user_id = u.id');
        $this->db->where("d.publish", 1);
        $this->db->where("d.used", 0);
        $this->db->where("u.active", 1);
        $this->db->where('d.end_date >', time());
        if($own){
            $this->db->where("u.own", $own);
        }
        if($play){
            $this->db->where("u.play", $play);
        }
        $result = $this->db->count_all_results('dating d');
		return $result;
    }
    function load_datings($limit=NULL, $page=NULL, $category_id=NULL, $own=NULL, $play=NULL){
        $this->db->limit($limit, $limit*$page);
		$this->db->select("u.id, u.gender, u.hide_avatar, u.avatar, u.name, u.day, u.month, u.year, u.height, u.weight, u.code, u.city, u.own, u.play, d.user_id, d.id  dating_id, d.title, d.alias, d.end_date, d.description, dc.white_icon");
        $this->db->from('dating d');
        $this->db->join('order_item oi', 'd.order_item_id = oi.id');
        $this->db->join('deal_category dc', 'dc.id = oi.category_id');
        $this->db->join('user u', 'd.user_id = u.id');
        $this->db->where("d.publish", 1);
        $this->db->where("d.used", 0);
        $this->db->where("u.active", 1);
        $this->db->where("d.end_date >", time());
        if($category_id){
            $this->db->where("oi.category_id", $category_id);
        }
        if($own){
            $this->db->where("u.own", $own);
        }
        if($play){
            $this->db->where("u.play", $play);
        }
        $this->db->order_by('d.id DESC');
        
        
		$result = $this->db->get();
		return $result->result();
	}

    function count_datings($category_id=NULL, $own=NULL, $play=NULL){
        $this->db->join('user u', 'd.user_id = u.id');
        $this->db->join('order_item oi', 'd.order_item_id = oi.id');
        $this->db->where("d.publish", 1);
        $this->db->where("d.used", 0);
        $this->db->where("u.active", 1);
        $this->db->where('d.end_date >', time());
        if($category_id){
            $this->db->where("oi.category_id", $category_id);
        }
        if($own){
            $this->db->where("u.own", $own);
        }
        if($play){
            $this->db->where("u.play", $play);
        }
        $result = $this->db->count_all_results('dating d');
		return $result;
    }
    function loadDating($id=NULL){
		$this->db->select("u.id, u.gender, u.hide_avatar, u.avatar, u.name, u.day, u.month, u.year, u.height, u.weight, u.city, u.own, u.play, d.id  dating_id, d.title, d.alias, d.end_date, d.description, d.order_item_id");
        $this->db->from('dating d');
        $this->db->join('user u', 'd.user_id = u.id');
        $this->db->where("u.active", 1);
        $this->db->where("d.id", $id);
		$result = $this->db->get();
		return $result->row();
	}
    function checkDating($id=NULL, $user=NULL){
        $this->db->where('dating_id', $id);
        $this->db->where('user_id', $user);
        $result = $this->db->get('dating_apply');
		return $result->row();
    }
    function applyDating($data=NULL){
        $this->db->insert('dating_apply', $data);
    }
    function checkView($id=NULL, $user=NULL){
        $this->db->where('fromid', $id);
        $this->db->where('toid', $user);
        $result = $this->db->get('viewprofile');
		return $result->row();
    }
    function addView($data=NULL){
        $this->db->insert('viewprofile', $data);
    }
    
    /** The End*/   
}