<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profiles extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('profiles_model');
    }

    function detail($id){
        $this->check_login();
        $user = getUser();
        //Add user view profile
        $check = $this->profiles_model->checkView($id, $user->id);
        if(!$check){
            $data['fromid'] = $id;
            $data['toid'] = $user->id;
            $data['time'] = time();
            $this->profiles_model->addView($data);
        }
        $data['user'] = $this->profiles_model->load_user_from_id($id);
        $data['photos'] = $this->profiles_model->load_photo_from_id($id, 20, 0);
        $data['blogs'] = $this->profiles_model->load_blog_from_id($id, 2, 0);
        $data['title']= $data['user']->name." profil";
		$data['content']='profiles/detail';
		$this->load->view('templates',$data,'');
    }
    
    function chat($id){
        $this->check_login();
        $this->profiles_model->clear_not_seen($id);
        $data['messages'] = $this->profiles_model->load_messages($id, 10, 0);
        $data['user'] = $this->profiles_model->load_user_from_id($id);
        $data['title']= $data['user']->name." - Budskab";
        $data['content']='profiles/messages';
		$this->load->view('templates',$data,'');
    }
    
    function message(){
        $this->check_login();
        $data['users'] = $this->profiles_model->load_users();
        $user = $this->profiles_model->load_name_from_id(getUser()->id);
        $data['title']= $user->name." - Meddelelseslisten";
        $data['content']='profiles/message_list';
		$this->load->view('templates',$data,'');
    }
    
    function ajax_save_message(){
        $message = $this->input->post('message');
        $from_id = $this->input->post('from_id');
        $to_id = $this->input->post('to_id');
        $attach_dating = $this->input->post('attach_dating');
        
        $time = $this->profiles_model->save_message($message, $from_id, $to_id, $attach_dating);
        $from_user = $this->profiles_model->load_name_from_id($from_id);
        
        $html = '<div class="comItem dark clearfix">
                    <div class="f-l" style="width:100px;">
                        <p>'.$from_user->name.'</p>
                        <span>'.get_time_difference_php($time).'</span> </div>
                    <div class="f-r w380">
                        <p>'.$message.'</p>
                    </div>
                </div>';
        echo $html;
        exit;
    }
    
    function deletemessage($userid,$id){
        $this->profiles_model->delete_message_FT($userid,$id);
        $this->profiles_model->delete_message_TF($userid,$id);
        redirect(base_url().index_page().'profiles/message.html');
    }
    
    function ajax_send_request(){
        $from_id = $this->input->post('from_id');
        $to_id = $this->input->post('to_id');
        $isOK = $this->profiles_model->check_request($from_id, $to_id);
        if($isOK){
            echo 2;
            exit();
        }else{
            $this->profiles_model->send_request($from_id, $to_id);
            echo 1;
            exit();
        }
        echo 0;
        exit();
    }
    
    function ajax_load_more_messages(){
        $offset = $this->input->post('offset');
        $to_id = $this->input->post('to_id');
        $html = $this->profiles_model->ajax_load_more_messages($to_id, $offset);
        echo $html;
        exit;
    }
    
    function create_block($id, $min, $max, $selected, $unit){
        $html = '<select id="'.$id.'">';
        for($i=$min; $i<=$max; $i++){
            if($i == $selected){
                $selected1 = 'selected';
            } else {
                $selected1 = '';
            }
            $html .= '<option value="'.$i.'" '.$selected1.'>'.$i.' '.$unit.'</option>';
        }
        $html .= '</select>';
        return $html;
    }
    
    function create_input($id, $text, $value){
        $html = '<div class="fl w225" style="width: 245px;">
                      <label for="">'.$text.'</label>
                      <input type="text" value="'.$value.'" id="'.$id.'" class="textbox">
                    </div>';
        return $html;
    }
    
    function ajax_get_sugar(){
        $id = $this->input->post('id');
        $page = $this->input->post('page');
        $function = $this->input->post('functionName');
        $min_old = $this->input->post('min_old');
        $max_old = $this->input->post('max_old');
        $min_height = $this->input->post('min_height');
        $max_height = $this->input->post('max_height');
        $min_weight = $this->input->post('min_weight');
        $max_weight = $this->input->post('max_weight');
        $min_code = $this->input->post('min_code');
        $max_code = $this->input->post('max_code');
        
        $num = 12;
		$sugars = $this->profiles_model->load_sugars($id, $num, $page-1, $min_old, $max_old, $min_height, $max_height, $min_weight, $max_weight, $min_code, $max_code);
        
        $sugar_num = $this->profiles_model->count_sugars($id, $min_old, $max_old, $min_height, $max_height, $min_weight, $max_weight, $min_code, $max_code);
        $page_num = ceil($sugar_num/$num);
        $own = array(1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
        
        $next = '';
        $prev = '';
        if($page<$page_num){
            $go = $page + 1;
            $next = '<a class="bntNext" href="javascript:'.$function.'('. $go .');">Næste <span class="red"> &gt; </span></a>';
        }
        if($page > 1){
            $go = $page - 1;
            $prev = '<a class="bntNext" href="javascript:'.$function.'('. $go .');"><span class="red"> &lt; </span> Tilbage </a>';
        }
        
        $data['own'] = $own;
        $data['page'] = $page;
        $data['page_num'] = $page_num;
        $data['function'] = $function;
        $data['next'] = $next;
        $data['prev'] = $prev;
        
        if(!$min_old){ $min_old = 18;}
        if(!$max_old){ $max_old = 115;}
        if(!$min_height){ $min_height = 0;}
        if(!$max_height){ $max_height = 250;}
        if(!$min_weight){ $min_weight = 0;}
        if(!$max_weight){ $max_weight = 300;}
        if(!$min_code){ $min_code = 0;}
        if(!$max_code){ $max_code = 9999;}
        
        $data['min_old_block'] = $this->create_block('min_old'.$id, 18, 115, $min_old, 'år');
        $data['max_old_block'] = $this->create_block('max_old'.$id, 18, 115, $max_old, 'år');
        $data['min_height_block'] = $this->create_block('min_height'.$id, 0, 250, $min_height, 'cm');
        $data['max_height_block'] = $this->create_block('max_height'.$id, 0, 250, $max_height, 'cm');
        $data['min_weight_block'] = $this->create_block('min_weight'.$id, 0, 300, $min_weight, 'kg');
        $data['max_weight_block'] = $this->create_block('max_weight'.$id, 0, 300, $max_weight, 'kg');
        $data['min_post_block'] = $this->create_input('min_code'.$id, 'Fra postnr.', $min_code);
        $data['max_post_block'] = $this->create_input('max_code'.$id, 'Til postnr.', $max_code);
        $data['id'] = $id;
        $data['sugars'] = $sugars;
        
		$this->load->view('content/profiles/ajaxgetsuga',$data,'');
    }
    
    function ajax_get_dating(){
        $page = $this->input->post('page');
        $category_id = $this->input->post('category_id');
        $own = $this->input->post('own');
        $play = $this->input->post('play');
        $num = 4;
        $datings = "";
        if($category_id){
            $allDating = $this->profiles_model->load_datings($num, $page-1, $category_id, $own, $play);
            $dating_num = $this->profiles_model->count_datings($category_id, $own, $play);
            if($allDating){
                foreach($allDating as $row){
                    $datings[] = array(
                        'id' => $row->id,
                        'user_id' =>$row->user_id,
                        'gender' => $row->gender,
                        'hide_avatar' => $row->hide_avatar,
                        'avatar' => $row->avatar,
                        'name' => $row->name,
                        'day' => $row->day,
                        'month' => $row->month,
                        'year' => $row->year,
                        'height' => $row->height,
                        'weight' => $row->weight,
                        'code' => $row->code,
                        'city' => $row->city,
                        'own' => $row->own,
                        'play' => $row->play,
                        'dating_id' => $row->dating_id,
                        'title' => $row->title,
                        'alias' => $row->alias,
                        'end_date' => $row->end_date,
                        'description' => $row->description,
                        'white_icon' => $row->white_icon,
                    );
                }
            }
        }else{
            $allDating = $this->profiles_model->load_datings1($num, $page-1, $own, $play);
            $dating_num = $this->profiles_model->count_datings1($own, $play);
            if($allDating){
                foreach($allDating as $row){
                    $icon = $this->profiles_model->load_icon_category($row->order_item_id);
                    if($icon){
                        $white_icon = $icon->white_icon;
                    }else{
                        $white_icon = "724b7666efdbb68edbf7c7cd9233216c.png";
                    }
                    $datings[] = array(
                        'id' => $row->id,
                        'user_id' =>$row->user_id,
                        'gender' => $row->gender,
                        'hide_avatar' => $row->hide_avatar,
                        'avatar' => $row->avatar,
                        'name' => $row->name,
                        'day' => $row->day,
                        'month' => $row->month,
                        'year' => $row->year,
                        'height' => $row->height,
                        'weight' => $row->weight,
                        'code' => $row->code,
                        'city' => $row->city,
                        'own' => $row->own,
                        'play' => $row->play,
                        'dating_id' => $row->dating_id,
                        'title' => $row->title,
                        'alias' => $row->alias,
                        'end_date' => $row->end_date,
                        'description' => $row->description,
                        'order_item_id' => $row->order_item_id,
                        'white_icon' => $white_icon,
                    );
                }
            }
        }
        $page_num = ceil($dating_num/$num);
        
        $next = '';
        if($page<$page_num){
            $go = $page + 1;
            $next = '<a class="bntNext" href="javascript:moreDating('. $go .');">Næste <span class="red"> &gt; </span></a>';
        }

        $prev = '';
        if($page > 1){
            $go = $page - 1;
            $prev = '<a class="bntNext" href="javascript:moreDating('. $go .');"><span class="red"> &lt; </span> Tilbage &nbsp </a>';
        }
        
        $typeArr = array(1 => "SugarBaby (M)", 2 => "SugarBaby (F)", 3 => "Sugar Dad", 4 => "Sugar Mom");
        $categories = $this->profiles_model->load_categories();
        
        $data['own'] = $own;
        $data['page'] = $page;
        $data['page_num'] = $page_num;
        $data['next'] = $next;
        $data['prev'] = $prev;
        
        $category_block = '';
        foreach($categories as $category){
            if($category_id == $category->id){
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $category_block .= '<option value="'.$category->id.'" '.$selected.'>'.$category->name.'</option>';
        }
        
        $own_block = '';
        foreach($typeArr as $typeKey => $typeValue){
            if($own == $typeKey){
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $own_block .= '<option value="'.$typeKey.'" '.$selected.'>'.$typeValue.'</option>';
        }
        
        $play_block = '';
        foreach($typeArr as $typeKey => $typeValue){
            if($play == $typeKey){
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $play_block .= '<option value="'.$typeKey.'" '.$selected.'>'.$typeValue.'</option>';
        }
        
        $data['category_block'] = $category_block;
        $data['own_block'] = $own_block;
        $data['play_block'] = $play_block;
        $data['datings'] = $datings;
        
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
        }
        else{
            $user = "";
        }
        $data['user'] = $user;
        
        $this->load->view('content/profiles/ajaxgetdating',$data,'');
    }
    function applyDating(){
        $dating_id = $this->input->post('id');
        $userCheck = $this->session->userdata('user');
        if($userCheck){
            $user = getUser();
            //Check apply dating
            $apply = $this->profiles_model->checkDating($dating_id, $user->id);
            if($apply){
                //Nothing to do
            }else{
                //Apply Dating
                $data['dating_id'] = $dating_id;
                $data['user_id'] = $user->id;
                $this->profiles_model->applyDating($data);
            }
            return true;
        }
        else{
            return false;
        }
    }
    function datingdetail($id){
        $userCheck = $this->session->userdata('user');
        if(!$userCheck){
            $this->session->set_flashdata('message', 'Log venligst på igen');
            redirect(base_url().index_page().'start.html');
        }
        $user = getUser();
        $datings = $this->profiles_model->loadDating($id);
        if($datings){
            $icon = $this->profiles_model->load_icon_category($datings->order_item_id);
            if($icon){
                $white_icon = $icon->white_icon;
            }else{
                $white_icon = "724b7666efdbb68edbf7c7cd9233216c.png";
            }
        }
        $data['dating'] = $datings;
        $data['white_icon'] = $white_icon;
        $data['user'] =  $user;
        
        $data['title'] = "Dating detalje - Sugar dating";
	    $data['content'] = 'profiles/dating_detail';
		$this->load->view('templates',$data,'');
    }
    function check_login(){
        $user = $this->session->userdata('user');
        if(!$user){
            $this->session->set_flashdata('message', 'Log venligst på igen');
            redirect(base_url().index_page().'user/login.html');
        }
    }
}
?>