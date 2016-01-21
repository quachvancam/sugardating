<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @access	public
 * @param	string
 * @return	string
 */	
//date_default_timezone_set('Asia/Ho_Chi_Minh'); // SET TIMEZONE

function seo_url($str) {
	$str = preg_replace("/(æ)/", 'ae', $str);
	$str = preg_replace("/(å)/", 'a', $str);
	$str = preg_replace("/(ø)/", 'o', $str);
	
	$str = preg_replace("/(Å)/", 'A', $str);
	$str = preg_replace("/(Æ)/", 'AE', $str);
	$str = preg_replace("/(Ø)/", 'O', $str);
	
	return url_title($str, 'dash', TRUE);
}
function getUser(){
    $ci =& get_instance();
    $user = $ci->session->userdata('user');
    if($user){
        $id = $user->id;
        $ci->load->database();
        $ci->db->select('*');
        $ci->db->where('id', $id);
        if($user->b2b){
            $result = $ci->db->get('b2b_user');
        }
        else{
            $result = $ci->db->get('user');
        }
        return $result->row();
    } else {
        return false;
    }
}
function check_friend($id){
    $ci =& get_instance();
    $user = $ci->session->userdata('user');
    $ci->load->database();
    $ci->db->select('id');
    $ci->db->where('from_id', $user->id);
    $ci->db->where('to_id', $id);
    $result = $ci->db->get('friends');

    return $result->num_rows();
}
function isB2b(){
    $ci =& get_instance();
    return $ci->session->userdata('b2b');
}

function isLogged(){
    $ci =& get_instance();
    if($ci->session->userdata('isLogged')) return true;
    else return false;
}

function get_config_value($config){
	$ci =& get_instance();
	
	$ci->load->database();
	$ci->db->select('value');
	$ci->db->where('config', $config);
	$result = $ci->db->get('config');
	return $result->row()->value;
}

function get_admin_email(){
    $ci =& get_instance();
	$ci->load->database();
	$ci->db->select('email');
	$ci->db->where('id', 1);
	$result = $ci->db->get('admin');
	return $result->row()->email;
}

function get_age($day, $month, $year){
	$bday_mm_dd = mktime(0, 0, 0, $month, $day, 0);
	$today_mm_dd = mktime(0, 0, 0, date("m"), date("d"), 0);
	$age = date("Y", time()) - $year;
	/*if ($bday_mm_dd > $today_mm_dd) {
		$age = $age;
	}*/
	return $age;
}

function member_type(){
    $ci =& get_instance();
    $user = $ci->session->userdata('user');
    if($user && !$user->b2b){
        $ci->load->database();
        $ci->db->select('member');
        $ci->db->where('id', $user->id);
        $result = $ci->db->get('user');
        return $result->row()->member;
    } else {
        return 0;
    }
}

function member_type_user($id=NULL){
    $ci =& get_instance();
    if($id){
        $ci->load->database();
        $ci->db->select('member');
        $ci->db->where('id', $id);
        $result = $ci->db->get('user');
        return $result->row()->member;
    } else {
        return 0;
    }
}

function priceFormat($price){
	$decimal_place = 2;
    $decimal_point = ',';
    $thousand_point = '.';
    $symbol = "";
    $string = "";
	$string .= number_format(round($price, (int)$decimal_place), (int)$decimal_place, $decimal_point, $thousand_point);
    $string = str_replace(',00',',-',$string);
	if ($symbol) {
  		$string = $string." ".$symbol;
	}
	return $string;
}

function get_time($time){
    $hours = ceil((time() - $time)/3600);
    $hours = $hours?$hours:1;
    if($hours > 24){
        $days = floor((time() - $time)/(3600*24));
        $tmp = time() - ($days*3600*24) - $time;
        if($days > 1){
            if($days > 7){
                return date("d-m-Y", $time);
            }
            return $days." dage siden";
        } else {
            return $days." dag siden";
        }
    } else {
        return $hours." timer";
    }
}

function get_time_difference_php($time)
{
    $str = $time;
    $today = time();
    // It returns the time difference in Seconds...
    $time_differnce = $today-$str;
    // To Calculate the time difference in Years...
    $years = 60*60*24*365;
    // To Calculate the time difference in Months...
    $months = 60*60*24*30;
    // To Calculate the time difference in Days...
    $days = 60*60*24;
    // To Calculate the time difference in Hours...
    $hours = 60*60;
    // To Calculate the time difference in Minutes...
    $minutes = 60;
    if(intval($time_differnce/$years) > 1)
    {
        return intval($time_differnce/$years)." år siden";
    }else if(intval($time_differnce/$years) > 0)
    {
        return intval($time_differnce/$years)." år siden";
    }else if(intval($time_differnce/$months) > 1)
    {
        return intval($time_differnce/$months)." måneder siden";
    }else if(intval(($time_differnce/$months)) > 0)
    {
        return intval(($time_differnce/$months))." måned siden";
    }else if(intval(($time_differnce/$days)) > 1)
    {
        return intval(($time_differnce/$days))." dage siden";
    }else if (intval(($time_differnce/$days)) > 0) 
    {
        return intval(($time_differnce/$days))." dag siden";
    }else if (intval(($time_differnce/$hours)) > 1) 
    {
        return intval(($time_differnce/$hours))." timer siden";
    }else if (intval(($time_differnce/$hours)) > 0) 
    {
        return intval(($time_differnce/$hours))." time siden";
    }else if (intval(($time_differnce/$minutes)) > 1) 
    {
        return intval(($time_differnce/$minutes))." minutter siden";
    }else if (intval(($time_differnce/$minutes)) > 0) 
    {
        return intval(($time_differnce/$minutes))." minut siden";
    }else if (intval(($time_differnce)) > 1) 
    {
        return intval(($time_differnce))." sekunder siden";
    }else
    {
        return "få sekunder siden";
    }
}

function get_item_per_page(){
	$ci =& get_instance();
	$item_per_page = $ci->session->userdata('item_per_page');
	if($item_per_page){
		return $item_per_page;
	} else {
		$ci->load->database();
		$ci->db->select('value');
		$ci->db->where('config', 'item_per_page');
		$result = $ci->db->get('config');
		return $result->row()->value;
	}
}

function get_order_category($user_id){
	$ci =& get_instance();
	$ci->load->database();
    $cat_out = array();
    $ci->db->select('id');
    $ci->db->from('order');
    $ci->db->where('status', 1);
    $ci->db->where('user_id', $user_id);
    $ci->db->order_by('id DESC');
    $result = $ci->db->get();
    $cat_num = 0;
    foreach($result->result() as $row){
        $ci->db->select('cat_id');
        $ci->db->from('order');
        $ci->db->where('id', $row->id);
        $result1 = $ci->db->get();
        $cat_str = $result1->row()->cat_id;
        $cat_arr = explode(',', $cat_str);
        array_pop($cat_arr);
        $cat_arr = array_unique($cat_arr);
        foreach($cat_arr as $cat){
            if(!in_array($cat, $cat_out)){
                array_push($cat_out, $cat);
                $cat_num++;
                if($cat_num==4) break;
            }
        }
        if($cat_num==4) break;
    }
    $html = '';
    if($cat_out){
        $ci->db->select('name, red_icon');
        $ci->db->from('deal_category');
        $ci->db->where_in('id', $cat_out);
        $result = $ci->db->get();
        foreach($result->result() as $row){
            $html .= '<a style="float: left;" class="tooltip"><span>'.$row->name.'</span><img src="'.base_url().get_config_value('upload_deal_category_path').$row->red_icon.'" alt="" width="25"/></a>';
        }
    }
    return $html;
}
function checkApplyDating($dating_id=NULL, $user_id=NULL){
    $ci =& get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->where('dating_id', $dating_id);
    $ci->db->where('user_id', $user_id);
    $result = $ci->db->get('dating_apply');
    return $result->row();
}
function checkLogin(){
    $ci =& get_instance();
    $user = $ci->session->userdata('user');
    if($user){
        return true;
    }else{
        return false;
    }
}
/** The End*/