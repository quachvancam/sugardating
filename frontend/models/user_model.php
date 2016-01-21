<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class User_Model extends CI_Model 
{
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function load_article($id){
        $this->db->select('title, short_content');
		$this->db->where('id', $id);
		$result = $this->db->get('article');
		return $result->row();
    }
    
    function check_b2b_login($email,$pass){
		$this->db->like('email', $email);
		$this->db->like('password', $pass); 
		$query = $this->db->get('b2b_user');
		return $query;
	}
    
    function check_login($email,$pass){
		$this->db->like('email', $email);
		$this->db->like('password', $pass); 
		$query = $this->db->get('user');
		return $query;
	}
    
	function update_login($userid, $isB2b = false){
        if($isB2b){
            $this->db->set('last_login', time());
            $this->db->where('id', $userid);
            $result = $this->db->update('b2b_user');
            return $result ? 1 : 0;
        } else {
            $this->db->set('last_login', time());
            $this->db->where('id', $userid);
            $result = $this->db->update('user');
            return $result ? 1 : 0;
        }
	}
    
    function check_registered_user($email){
        $this->db->select('id');
		$this->db->where('email', $email);
        $this->db->where('facebook_id', 0);
		$result = $this->db->get('user');
		return $result->row();
    }
    
    function check_logged_user($email){
        $this->db->select('id');
		$this->db->where('email', $email);
        $this->db->where('facebook_id !=', 0);
		$result = $this->db->get('user');
		return $result->row();
    }
    
    function save_user($user){
        $this->db->set('email', $user->email);
        $this->db->set('name', $user->name);
        
        $gender = $user->gender=="male" ? 1 : 0;
        $this->db->set('gender', $gender);
        
        $tmp = explode("/", $user->birthday);
        $this->db->set('day', $tmp[1]);
        $this->db->set('month', $tmp[0]);
        $this->db->set('year', $tmp[2]);
        
        $tmp = explode(',', $user->location['name']);
        $this->db->set('city', $tmp[0]);
        $this->db->set('member', 1);
        $this->db->set('facebook_id', $user->id);
        $this->db->set('see_profile', 1);
        $this->db->set('active', 1);
        $this->db->set('publish', 1);
        
		$result = $this->db->insert('user');
		return $result;
    }
    
    function update_user($user){
        $this->db->set('name', $user->name);
        
        $gender = $user->gender=="male" ? 1 : 0;
        $this->db->set('gender', $gender);
        
        $tmp = explode("/", $user->birthday);
        $this->db->set('day', $tmp[1]);
        $this->db->set('month', $tmp[0]);
        $this->db->set('year', $tmp[2]);
        
        $tmp = explode(',', $user->location['name']);
        $this->db->set('city', $tmp[0]);
        $this->db->set('member', 1);
        $this->db->set('facebook_id', $user->id);
        
        $this->db->where('email', $user->email);
		$result = $this->db->update('user');
		return $result;
    }
    
    function load_info_user($email){
        $this->db->select('*');
		$this->db->where('email', $email);
		$result = $this->db->get('user');
		return $result->row();
    }
    
    function save_verify_code($email, $code){
        $this->db->set('verify_code', $code);
        $this->db->where('email', $email);
        $result = $this->db->update('user');
		return $result;
    }
    
    function check_user($email){
        $this->db->select('facebook_id');
		$this->db->where('email', $email);
		$result = $this->db->get('user');
		return $result;
    }
    
    function get_user_from_email($email){
        $this->db->select('id, name');
		$this->db->where('email', $email);
		$result = $this->db->get('user');
		return $result->row();
    }
    
    function get_verify_code($id){
        $this->db->select('verify_code');
		$this->db->where('id', $id);
		$result = $this->db->get('user');
		return $result->row()->verify_code;
    }
    
    function change_password($user_id, $pass){
        $this->db->set('password', md5($pass));
        $this->db->where('id', $user_id);
        $result = $this->db->update('user');
		return $result;
    }
    
    function delete_verify_code($user_id){
        $this->db->set('verify_code', '');
        $this->db->where('id', $user_id);
        $result = $this->db->update('user');
		return $result;
    }
	
	function save_add_user(){
		$verify_code = md5(time().$this->input->post('email'));
		$this->db->set('email', 	$this->input->post('email'));
		$this->db->set('password', 	md5($this->input->post('password')));
		$this->db->set('name', 		$this->input->post('name'));
		$this->db->set('gender', 	$this->input->post('gender'));
		$this->db->set('day', 		$this->input->post('day'));
		$this->db->set('month',		$this->input->post('month'));
		$this->db->set('year', 		$this->input->post('year'));
		$this->db->set('own', 		$this->input->post('own'));
		$this->db->set('play', 		$this->input->post('play'));
		$this->db->set('member',	1);
		$this->db->set('facebook_id', 		0);
		$this->db->set('register_time',	time());
		$this->db->set('verify_code', $verify_code);
        $this->db->set('see_profile',	1);
        $this->db->set('active',	1);
		$this->db->set('publish',	1);
		
		$result = $this->db->insert('user');
		if($result){
			return $verify_code;
		} else {
			return false;
		}
	}
    
    function get_user_id($email){
        $this->db->select('id');
		$this->db->where('email', $email);
		$result = $this->db->get('user');
		return $result->row()->id;
    }
    
    function get_user_from_id($id){
        $this->db->select('email, name');
		$this->db->where('id', $id);
		$result = $this->db->get('user');
		return $result->row();
    }
    
    function upgrade_member($id){
        $this->db->set('member', 2);
        $this->db->set('payment_time', time());
        $this->db->where('id', $id);
        $result = $this->db->update('user');
		return $result;
    }
    
    function save_status(){
        $user = getUser();
        $this->db->set('status', $this->input->post('status'));
        $this->db->where('id', $user->id);
        $result = $this->db->update('user');
        return $result;
    }
    
    function updateProfile($id=NULL, $data=NULL){
        $this->db->where('id', $id);
		return $this->db->update('user', $data);
    }
    function update_profile(){
        $user = getUser();
		if($this->input->post('password')){
			$this->db->set('password', 	md5($this->input->post('password')));
		}
		$this->db->set('name', 		$this->input->post('name'));
		$this->db->set('gender', 	$this->input->post('gender'));
		$this->db->set('day', 		$this->input->post('day'));
		$this->db->set('month',		$this->input->post('month'));
		$this->db->set('year', 		$this->input->post('year'));
		$this->db->set('height', 	$this->input->post('height'));
		$this->db->set('weight',	$this->input->post('weight'));
		$this->db->set('hide_avatar', $this->input->post('hide_avatar'));
		$this->db->set('code', 		$this->input->post('code'));
		$this->db->set('city', 		$this->input->post('city'));
		$this->db->set('own', 		$this->input->post('own'));
		$this->db->set('play', 		$this->input->post('play'));
        $this->db->set('slogan',	$this->input->post('slogan'));
		$this->db->set('description',	$this->input->post('description'));
        $this->db->set('see_profile',	$this->input->post('see_profile'));
		
		$this->db->where('id', $user->id);
		$result = $this->db->update('user');
		return $result;
	}
    
    function load_avatar_name($id){
		$this->db->select('avatar');
		$this->db->where('id', $id);
		$result = $this->db->get('user');
		return $result->row()->avatar;
	}
    
    function deactivate(){
        $user = getUser();
        $this->db->set('active', 0);
        $this->db->where('id', $user->id);
        $result = $this->db->update('user');
		return $result;
    }
    
    function activate(){
        $user = getUser();
        $this->db->set('active', 1);
        $this->db->where('id', $user->id);
        $result = $this->db->update('user');
		return $result;
    }
    
    function ajax_load_postcode($code=NULL){
        $this->db->select('*');
        $this->db->from('postnumber');
        $this->db->where('number', $code);
        $result = $this->db->get();	
        return $result->row();
    }
    //Blog
    function get_total_blog(){
        $user = getUser();
        $this->db->where('user_id', $user->id);
        $this->db->from('blog');
		$result = $this->db->count_all_results();
		return $result;
	}
    
    function load_all_blog($num, $offset){
        $user = getUser();
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('blog');
        $this->db->where('user_id', $user->id);
        $this->db->order_by('time DESC');
		$result = $this->db->get();		

		return $result->result();
	}
    
    function load_blog($id){
        $this->db->select('*');
		$this->db->from('blog');
        $this->db->where('id', $id);
		$result = $this->db->get();		

		return $result->result();
    }
    
    function add_blog(){
        $user = getUser();
        $config['upload_path'] = get_config_value('upload_blog_path');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= get_config_value('max_size');
		$config['encrypt_name']	= TRUE;    // rename to random string

		$this->load->library('upload', $config);

		if($_FILES['image']['name']){
			if ($this->upload->do_upload('image')){	
				$datax = $this->upload->data();
			} else {
				die($this->upload->display_errors());
			}
		} else {
			$datax['file_name'] = NULL;				
		}
		
		$this->db->set('user_id',	$user->id);
        $this->db->set('title',	$this->input->post('title'));
        $this->db->set('alias',	seo_url($this->input->post('title')));
        $this->db->set('content',	$this->input->post('content'));
		$this->db->set('image',		$datax['file_name']);
		$this->db->set('time',		time());
		$this->db->set('publish',	1);
		
		$result = $this->db->insert('blog');
        $this->add_activity($user->id, 1, $this->db->insert_id(), $this->input->post('title'));
		return $result;
    }
    
    function check_own($id){
        $user = getUser();
        $this->db->select('user_id');
		$this->db->from('blog');
        $this->db->where('id', $id);
		$result = $this->db->get();
        if($result->row()->user_id == $user->id){
            return true;
        } else {
            return false;
        }
    }
    
    function delete_blog($id){
        $this->db->select('image');
        $this->db->from('blog');
        $this->db->where('id', $id);
		$result = $this->db->get();
		$image = $result->row()->image;

        $this->db->where('id', $id);
		$result = $this->db->delete('blog');
		if($image && $result){
			if(!unlink('upload/blog/'.$image)){
				return false;
			}
		}
		return $result;
    }
    
    function edit_blog(){
        if($_FILES['image']['name']){
            $this->db->select('image');
            $this->db->from('blog');
            $this->db->where('id', $this->input->post('id'));
            $result = $this->db->get();
            $image = $result->row()->image;
            if($image){
                unlink('upload/images/'.$image);
            }
			$config['upload_path'] = get_config_value('upload_blog_path');
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
		
		$this->db->set('title', $this->input->post('title'));
		$this->db->set('alias', seo_url($this->input->post('title')));
		$this->db->set('content', $this->input->post('content'));
		$this->db->where('id', $this->input->post('id'));
		$result = $this->db->update('blog');
		return $result;
    }
    // End blog
    
    //Photo
    function get_total_photo(){
        $user = getUser();
        $this->db->where('user_id', $user->id);
        $this->db->from('gallery');
		$result = $this->db->count_all_results();
		return $result;
	}
    
    function load_all_photo($num, $offset){
        $user = getUser();
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('gallery');
        $this->db->where('user_id', $user->id);
        $this->db->order_by('time DESC');
		$result = $this->db->get();		

		return $result->result();
	}
    
    function add_photo($user_id){
		$config['upload_path'] = get_config_value('upload_gallery_path');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= get_config_value('max_size');
		$config['encrypt_name']	= TRUE;    // rename to random string

		$this->load->library('upload', $config);

		if($_FILES['upl']['name']){
			if ($this->upload->do_upload('upl')){	
				$datax = $this->upload->data();
			} else {
				die($this->upload->display_errors());
			}
		} else {
			$datax['file_name'] = NULL;				
		}
		
		$this->db->set('user_id',	$user_id);
		$this->db->set('image',		$datax['file_name']);
		$this->db->set('time',		time());
		$this->db->set('publish',	1);
		
		$result = $this->db->insert('gallery');
		return $result;
	}
    
    function check_photo_own($id){
        $user = getUser();
        $this->db->select('user_id');
		$this->db->from('gallery');
        $this->db->where('id', $id);
		$result = $this->db->get();
        if($result->row()->user_id == $user->id){
            return true;
        } else {
            return false;
        }
    }
    
    function save_photo($num){
        $user = getUser();
        $this->add_activity($user->id, 2, '', $num);
        return true;
    }
    
    function delete_photo($id){
        $this->db->select('image');
        $this->db->from('gallery');
        $this->db->where('id', $id);
		$result = $this->db->get();
		$image = $result->row()->image;

        $this->db->where('id', $id);
		$result = $this->db->delete('gallery');
		if($result){
			if(!unlink('upload/gallery/'.$image)){
				return false;
			}
		}
		return $result;
    }
    // End photo
    
    //Activity
    function load_activities(){
        $i = 0;
        $offset = 0;
        $actArr = array();
        while($i < 3){
            $this->db->limit(1, $offset);
            $this->db->select('id, user_id');
            $this->db->from('activity');
            $this->db->order_by('time DESC');
            $result = $this->db->get();
            $act = $result->row(); 
            if(!$act){
                break;
            }
            $isOK = check_friend($act->user_id);
            if($isOK){
                array_push($actArr, $act->id);
                $i++;
            }
            $offset ++;
        }
        if(!$actArr){
            return false;
        }
        $this->db->select('*');
        $this->db->from('activity a');
        $this->db->join('user u', 'a.user_id=u.id ');
        $this->db->where_in('a.id', $actArr);
        $this->db->order_by('a.time DESC');
        $result = $this->db->get();
        
		return $result->result();
	}
    
    function ajax_load_more_activity($offset){
        $i = 0;
        $actArr = array();
        while($i < 3){
            $this->db->limit(1, $offset);
            $this->db->select('id, user_id');
            $this->db->from('activity');
            $this->db->order_by('time DESC');
            $result = $this->db->get();
            $act = $result->row();
            if(!$act){
                break;
            }
            $isOK = check_friend($act->user_id);
            if($isOK){
                array_push($actArr, $act->id);
                $i++;
            }
            $offset ++;
        }
        if(!$actArr){
            return false;
        }
        $this->db->select('*');
        $this->db->from('activity a');
        $this->db->join('user u', 'a.user_id=u.id ');
        $this->db->where_in('a.id', $actArr);
        $this->db->order_by('a.time DESC');
        $result = $this->db->get();
        $html = '';
        foreach($result->result() as $activity){
            $profile_link = base_url().index_page().'profiles/detail/'.$activity->id.'/'.$activity->name.'.html';
            $html .= '<div class="commentItem"><div class="f-l w420"><a href="'.$profile_link.'">';
            if($activity->avatar){    
                $html.='<img alt="" src="'.base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$activity->avatar.'&q=100&w=29&h=29" />';
            }
            else{
                $html.='<img alt="" src="'.base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').'noavatar'.$activity->gender.'.jpg&q=100&w=29&h=29" />';
            }
            $html.='</a><p><span class="userName"><a href="'.$profile_link.'">'.$activity->name.'</a></span>';
            if($activity->type == 1){
                $html.=' har postet <strong>'.$activity->data.'</strong>';
            } else if($activity->type == 2){
                $html.=' har tilføjet <strong>'.$activity->data.'</strong> billeder';
            } else {
            }   
            $html .='</p></div><div class="f-r w100 text-r"><p>'.get_time_difference_php($activity->time).'</p></div></div>';       
        }
		return $html;
	}
    
    //End activity
    
    //Friend request
    function load_all_request(){
        $user = getUser();
		$this->db->select('fr.from_id, u.*');
		$this->db->from('friend_request fr');
        $this->db->join('user u', 'fr.from_id=u.id');
        $this->db->where('fr.to_id', $user->id);
        $this->db->order_by('fr.time DESC');
		$result = $this->db->get();		

		return $result->result();
	}
    
    function accept_request($id){
        $user = getUser();
        $check = $this->checkFriend($id,$user->id);
        if($check){
            //Nothing
        }else{
            $this->db->set('from_id', $id);
            $this->db->set('to_id',	$user->id);
            $this->db->set('time', time());
            $this->db->insert('friends');
        }
        $check1 = $this->checkFriend($user->id,$id);
        if($check1){
            //Nothing
        }else{
            $this->db->set('from_id', $user->id);
            $this->db->set('to_id',	$id);
            $this->db->set('time', time());
            $this->db->insert('friends');
        }
        $this->db->where('from_id', $id);
        $this->db->where('to_id', $user->id);
		$result = $this->db->delete('friend_request');
        return $result;
    }
    function checkFriend($from, $to){
        $this->db->select('*');
        $this->db->from('friends');
        $this->db->where('from_id', $from);
        $this->db->where('to_id', $to);
        $result = $this->db->get();
		return $result->result();
    }
    
    
    function reject_request($id){
        $user = getUser();
        $this->db->where('from_id', $id);
        $this->db->where('to_id', $user->id);
		$result = $this->db->delete('friend_request');
        return $result;
    }
    
    function load_all_friends(){
        $user = getUser();
        $this->db->select('u.*');
		$this->db->from('friends f');
        $this->db->join('user u', 'f.to_id=u.id');
        $this->db->where('f.from_id', $user->id);
        $this->db->order_by('u.name');
		$result = $this->db->get();
		return $result->result();
    }
    
    function check_friend($id){
        $user = getUser();
        $this->db->select('id');
		$this->db->from('friends');
        $this->db->where('from_id', $user->id);
        $this->db->where('to_id', $id);
		$result = $this->db->get();		

        if($result->row()->id){
            return true;
        } else {
            return false;
        }
    }
    
    function remove_friend($id){
        $user = getUser();
        
        $this->db->where('from_id', $id);
        $this->db->where('to_id', $user->id);
		$this->db->delete('friends');
        
        $this->db->where('to_id', $id);
        $this->db->where('from_id', $user->id);
		$result = $this->db->delete('friends');
        
        return $result;
    }
    
    function add_activity($user_id, $type, $content_id, $content_data){
        $this->db->set('user_id',	$user_id);
        $this->db->set('type',	$type);
        $this->db->set('content_id',	$content_id);
        $this->db->set('data',	$content_data);
        $this->db->set('time',	time());
        $result = $this->db->insert('activity');
    }
    
    /** DATING*/
    function get_vouchers(){
        $user = getUser();
        $this->db->select('oi.id, oi.category_id, oi.name, oi.codes');
        $this->db->from('order_item oi');
        $this->db->join('order o', 'oi.order_id=o.id');
        $this->db->where('oi.status', 0);
        $this->db->where('oi.used', 0);
        $this->db->where('o.status', 1);
        $this->db->where('o.user_id', $user->id);
        $this->db->order_by('oi.id');
        $result = $this->db->get();	
        return $result->result();
    }
    function get_vouchers_id($id=NULL){
        $user = getUser();
        $this->db->select('oi.id, oi.category_id, oi.name, oi.codes');
        $this->db->from('order_item oi');
        $this->db->join('order o', 'oi.order_id=o.id');
        $this->db->where('oi.id', $id);
        $this->db->where('oi.used', 0);
        $this->db->where('o.status', 1);
        $this->db->where('o.user_id', $user->id);
        $this->db->order_by('oi.id');
        $result = $this->db->get();	
        return $result->row();
    }
    function get_datings($num, $offset){
        $user = getUser();
        $this->db->limit($num, $offset);
        $this->db->select('d.*');
        $this->db->from('dating d');
        $this->db->where('d.user_id', $user->id);
        #$this->db->where('d.publish', 1);
        $this->db->order_by('d.end_date DESC');
        $result = $this->db->get();
        return $result->result();
    }
    
    function count_datings(){
        $user = getUser();
        $this->db->where('user_id', $user->id);
        #$this->db->where('publish', 1);
        $this->db->from('dating');
		$result = $this->db->count_all_results();
		return $result;
	}
    
    function get_dating($id){
        $this->db->select('d.*');
        $this->db->from('dating d');
        $this->db->where('id', $id);
        $result = $this->db->get();	
        return $result->row();
    }
    
    function save_dating(){
        $user = getUser();
        $hour = $this->input->post('hour');
        $minute = $this->input->post('minute');
        $date = $this->input->post('date');
        $vipid = $this->input->post('vipid');
        $tmp = explode("-", $date);
        $end_date = mktime($hour, $minute, 0, $tmp[1], $tmp[0], $tmp[2]);
        $this->db->set('user_id', $user->id);
        $this->db->set('title', $this->input->post('title'));
        $this->db->set('alias', seo_url($this->input->post('title')));
        $this->db->set('order_item_id', $this->input->post('order_item_id'));
        $this->db->set('end_date', $end_date);
        $this->db->set('description', $this->input->post('description'));
        $this->db->set('time', time());
        if($vipid){
            $this->db->set('publish', 0);
            $this->db->set('uservip', $vipid);
            $this->db->set('timevip', time());
        }else{
            $this->db->set('publish', 1);
        }
        $result = $this->db->insert('dating');
		return $result;
    }
    
    function update_dating(){
        $user = getUser();
        $hour = $this->input->post('hour');
        $minute = $this->input->post('minute');
        $date = $this->input->post('date');
        $vipid = $this->input->post('vipid');
        $tmp = explode("-", $date);
        $end_date = mktime($hour, $minute, 0, $tmp[1], $tmp[0], $tmp[2]);
        $this->db->set('user_id', $user->id);
        $this->db->set('title', $this->input->post('title'));
        $this->db->set('alias', seo_url($this->input->post('title')));
        //$this->db->set('order_item_id', $this->input->post('order_item_id'));
        $this->db->set('end_date', $end_date);
        $this->db->set('description', $this->input->post('description'));
        if($vipid){
            $this->db->set('publish', 0);
            $this->db->set('uservip', $vipid);
            $this->db->set('timevip', time());
        }else{
            $this->db->set('publish', 1);
        }
        $this->db->where('id', $this->input->post('id'));
        $result = $this->db->update('dating');
		return $result;
    }
    
    function check_dating_owner($id){
        $user = getUser();
        $this->db->select('user_id');
		$this->db->from('dating');
        $this->db->where('id', $id);
		$result = $this->db->get();
        if($result->row()->user_id == $user->id){
            return true;
        } else {
            return false;
        }
    }
    
    function getIconCategory($id=NULL){
        $this->db->select('dc.white_icon, d.name, d.id');
        $this->db->from('deal_category dc');
        $this->db->join('order_item oi', 'oi.category_id = dc.id');
        $this->db->join('deal d', 'd.id = oi.deal_id');
        $this->db->where('oi.id', $id);
		$result = $this->db->get();
		return $result->row();
	}
    function loadDatingApply($id=NULL){
   	    $this->db->select("da.dating_id, da.user_id, da.status, u.name, u.id AS userid, u.avatar, u.gender");
        $this->db->from('dating_apply da');
        $this->db->join('user u', 'da.user_id = u.id');
        $this->db->where("da.dating_id", $id);
		$result = $this->db->get();
		return $result->result();
    }
    function loadDatingApplyUser($userid=NULL){
   	    $this->db->select("da.id AS applyid, da.status, d.*, u.name, u.gender, u.avatar");
        $this->db->from('dating_apply da');
        $this->db->join('dating d', 'd.id = da.dating_id');
        $this->db->join('user u', 'u.id = d.user_id');
        $this->db->where("da.user_id", $userid);
		$result = $this->db->get();
		return $result->result();
    }
    function loadDatingApplyVip($userid=NULL){
   	    $this->db->select("d.*, u.name, u.gender, u.avatar");
        $this->db->from('dating d');
        $this->db->join('user u', 'u.id = d.user_id');
        $this->db->where("uservip", $userid);
		$result = $this->db->get();
		return $result->result();
    }
    function updateDatingApply($dating_id=NULL, $user_id=NULL){
        $this->db->set('status', 1);
        $this->db->where('dating_id', $dating_id);
        $this->db->where('user_id', $user_id);
        $result = $this->db->update('dating_apply');
		return $result;
    }
    function updateDating($id=NULL){
        $this->db->set('used', 2);
        $this->db->where('id', $id);
        $result = $this->db->update('dating');
		return $result;
    }
    function denialDatingApply($dating_id=NULL, $status=NULL){
        $this->db->set('status', -1);
        $this->db->where('dating_id', $dating_id);
        $this->db->where('status', $status);
        $result = $this->db->update('dating_apply');
		return $result;
    }
    function deleteDatingApply($id=NULL){
        $this->db->where('id', $id);
        $this->db->delete('dating_apply');
    }
    function toDatingApply($id=NULL,$type=NULL){
        $this->db->set($type, 1);
        $this->db->where('id', $id);
        $result = $this->db->update('dating');
		return $result;
    }
    function checkItemDating($id=NULL){
        $this->db->select("oi.id");
        $this->db->from('order_item oi');
        $this->db->join('dating d', 'd.order_item_id = oi.id');
        $this->db->where("oi.status", 0);
        $this->db->where("d.id", $id);
		$result = $this->db->get();
		return $result->row();
    }
    
    function updateVoucher($id=NULL){
        $this->db->set('used', 0);
        $this->db->where('id', $id);
        $result = $this->db->update('order_item');
		return $result;
    }
    
    function sletDating($id=NULL){
        $this->db->where('id', $id);
        $this->db->delete('dating');
    }
    function sletDatingApply($id=NULL){
        $this->db->where('dating_id', $id);
        $this->db->delete('dating_apply');
    }
    
    function deleteVip($id=NULL){
        $this->db->set('publish', 1);
        $this->db->set('uservip', "");
        $this->db->set('timevip', 0);
        $this->db->where('id', $id);
		$result = $this->db->update('dating');
		return $result;
    }
    
    function getUserLimit($limit=NULL, $IDlogin=NULL){
        $this->db->from('user');
       	$this->db->limit($limit);
        if($IDlogin){
            $this->db->where('id !=', $IDlogin);
        }
        $this->db->where('active', 1);
        $this->db->where('publish', 1);
        $this->db->order_by('id', 'DESC');
		$result = $this->db->get();
		return $result->result();
    }
    function getUserName($name=NULL, $IDlogin=NULL){
        $this->db->from('user');
       	$this->db->like('name', $name); 
        if($IDlogin){
            $this->db->where('id !=', $IDlogin);
        } 
        $this->db->where('active', 1);
        $this->db->where('publish', 1);
        $this->db->order_by('id', 'DESC');
		$result = $this->db->get();
		return $result->result();
    }
    function getUserNameID($id=NULL, $IDlogin=NULL){
        $this->db->from('user');
       	$this->db->where('id', $id); 
        if($IDlogin){
            $this->db->where('id !=', $IDlogin);
        }
        $this->db->where('active', 1);
        $this->db->where('publish', 1);
        $this->db->order_by('id', 'DESC');
		$result = $this->db->get();
		return $result->result();
    }
    function getUserID($id=NULL){
        $this->db->from('user');
       	$this->db->where('id', $id); 
        $this->db->where('active', 1);
        $this->db->where('publish', 1);
		$result = $this->db->get();
		return $result->row();
    }
    /** The End*/
}