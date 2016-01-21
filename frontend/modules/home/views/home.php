<?php 
$own = array(1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
?>
<script type="text/javascript">
jQuery(document).ready( function(){
    jQuery("#slidechat").carouFredSel({
        height : 170,
		auto			: false,
		items	: 4,
		scroll	: {
			items			: 4,
			duration		: 1000,
			timeoutDuration	: 2000
		},
		prev			:'#foo3_prev',
		next			:'#foo3_next'
	});
    jQuery("#slideblog").carouFredSel({
		auto			: false,
		items	 : 2,
		scroll	: {
			items			: 2,
			duration		: 1000,
			timeoutDuration	: 2000
		},
		height	: 184,
		prev			:'#foo4_prev',
		next			:'#foo4_next'
	});
});
function checkstatus_chatme(data){
    //console.log(data); // To see output using Firebug
    if (data.s == 'available') {
        $("#online_chatme_"+data.id).append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconchop.gif" />');
    } else {
        $("#online_chatme_"+data.id).append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconDoc-Red.png" />');
    }
}
<?php for($i=0; $i<$blogs_num; $i++){?>
function checkstatus_blog_<?php echo $i;?>(data){
    //console.log(data); // To see output using Firebug
    if (data.s == 'available') {
        $("#online_blog_<?php echo $i;?>_"+data.id).append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconchop.gif" />');
    } else {
        $("#online_blog_<?php echo $i;?>_"+data.id).append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconDoc-Red.png" />');
    }
}
<?php }?>
window.onload = function() {
    <?php foreach($users as $user){?>
    jqcc.cometchat.getUser('<?php echo $user->id;?>','checkstatus_chatme');
    <?php }?>
    <?php for($i=0; $i<$blogs_num; $i++){?>
    jqcc.cometchat.getUser('<?php echo $blogs[$i]->user_id;?>','checkstatus_blog_<?php echo $i;?>');
    <?php }?>
}
</script>
<div class="chatMe bgContent2 clearfix" style="height: 235px; overflow: hidden;">
    <h2>Chat mig</h2>
    <a id="foo3_next" class="bntNext" href="javascript:void(0);">Næste <span class="red"> &gt; </span></a> <a id="foo3_prev" class="bntPev" href="javascript:void(0);"><span class="red"> &lt; </span> Tilbage</a>
    <div class="clear"></div>
    <ul id="slidechat">
        <?php foreach($users as $key=>$user){
               if(isLogged() && getUser()->member == 2){
                   $profile_link = base_url().index_page()."profiles/detail/".$user->id."/".$user->name.".html";
                   $chat_link = "javascript:jqcc.cometchat.chatWith('".$user->id."');";
               } else {
                   $profile_link = "javascript:void(0);";
                   $chat_link = "javascript:void(0);";
               }
               $hide_text = '';
               if($user->avatar){
                   if($user->hide_avatar && !isLogged()){
                       $avatar = 'hideavatar.jpg';
                       $hide_text = 'Billede kun synligt for medlemmer';
                   } else {
                       $avatar = $user->avatar;
                   }
               } else {
                   $avatar = 'noavatar'.$user->gender.'.jpg';
               }
        ?>
        <li <?php if($key == $users_num-1) echo 'class="end"';?>>
            <h3><?php echo $user->name;?><span style="margin-left: 3px;" id="online_chatme_<?php echo $user->id;?>"></span></h3>
            <div class="icon">
                <a class="normalTip" <?php if($user->own){?>title="<?php echo $own[$user->own];?>"<?php }?>>
                    <?php if($user->own){?>
                    <img src="<?php echo base_url(); ?>/assets/frontend/img/icon<?php echo $user->own;?>-2.png"/>
                    <?php }?>
                </a>
            </div>
            <div class="imgPeople"><a href="<?php echo $profile_link;?>" <?php if(!isLogged()){?>data-reveal-id="f-errorPage"<?php }?> <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?> title="<?php echo $hide_text;?>">
                <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().'upload/user/'.$avatar.'&w=60&h=90&q=70'; ?>"/>
            </a></div>
            <div class="infoPeople"><?php echo implode(' ', array_slice(explode(' ', $user->status), 0, 10)).'...';?></div>
            <div class="status clearfix">
                <?php echo get_order_category($user->id);?>
            <a class="bntChatme" href="<?php echo $chat_link;?>" <?php if(!isLogged()){?>data-reveal-id="f-errorPage"<?php }?> <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Chat mig !</a> 
            </div>
        </li>
        <?php }?>
    </ul>
</div>
<div class="sugarBlogs bgContent clearfix" style="height: 245px; overflow: hidden;">
    <h2>Sugar Blogs</h2>
    <a id="foo4_next" class="bntNext" href="javascript:void(0);">Næste <span class="red"> &gt; </span></a> <a id="foo4_prev" class="bntPev" href="javascript:void(0);"><span class="red"> &lt; </span> Tilbage</a>
    <div class="clear"></div>
    <ul id="slideblog">
        <?php for($i=0; $i<$blogs_num; $i=$i+2){
            if(isLogged()){
                $profile_link1 = base_url().index_page()."profiles/detail/".$blogs[$i]->user_id."/".$blogs[$i]->name.".html";
                if((($blogs_num%2) && ($blogs_num!=($i+1))) || ($blogs_num%2==0)){
                    $profile_link2 = base_url().index_page()."profiles/detail/".$blogs[$i+1]->user_id."/".$blogs[$i+1]->name.".html";
                }
            } else {
               $profile_link1 = "javascript:void(0);";
               $profile_link2 = "javascript:void(0);";
            }
            
            $hide_text = '';
            if($blogs[$i]->avatar){
               if($blogs[$i]->hide_avatar && !isLogged()){
                   $avatar1 = 'hideavatar.jpg';
                   $hide_text = 'Billede kun synligt for medlemmer';
               } else {
                   $avatar1 = $blogs[$i]->avatar;
               }
            } else {
               $avatar1 = 'noavatar'.$blogs[$i]->gender.'.jpg';
            }
            
			if(isLogged()){
            	$blog_detail1 = base_url().index_page()."blog/detail/".$blogs[$i]->blog_id."/".$blogs[$i]->alias.".html";
				if((($blogs_num%2) && ($blogs_num!=($i+1))) || ($blogs_num%2==0)){
					$blog_detail2 = base_url().index_page()."blog/detail/".$blogs[$i+1]->blog_id."/".$blogs[$i+1]->alias.".html";
				}
			} else {
               $blog_detail1 = "javascript:void(0);";
               $blog_detail2 = "javascript:void(0);";
            }
        ?>
        <li>
            <div>
                <h3 class="clearfix">
                    <div class="name"><?php echo $blogs[$i]->name;?><span style="margin-left: 3px;" id="online_blog_<?php echo $i.'_'.$blogs[$i]->user_id;?>"></span></div>
                    <div class="clock"><?php echo get_time_difference_php($blogs[$i]->time);?></div>
                </h3>
                <div class="icon">
                    <a class="normalTip" <?php if($blogs[$i]->own){?>title="<?php echo $own[$blogs[$i]->own];?>"<?php }?>><img src="<?php echo base_url(); ?>assets/frontend/img/icon<?php echo $blogs[$i]->own;?>-2.png" alt=""/></a>
                </div>
                <div class="imgPeople2">
                    <a href="<?php echo $profile_link1;?>" <?php if(!isLogged()){?>data-reveal-id="f-errorPage"<?php }?> title="<?php echo $hide_text;?>">
                        <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$avatar1.'&w=47&h=70&q=70'; ?>" alt=""/>
                    </a>
                </div> 
                <a href="<?php echo $blog_detail1;?>" class="infoPeople2" <?php if(!isLogged()){?>data-reveal-id="f-errorPage"<?php }?>><?php echo implode(' ', array_slice(explode(' ', strip_tags($blogs[$i]->content)), 0, 10)).'...';?></a>
            </div>
            <?php if((($blogs_num%2) && ($blogs_num!=($i+1))) || ($blogs_num%2==0)){
                $hide_text = '';
                if($blogs[$i+1]->avatar){
                   if($blogs[$i+1]->hide_avatar && !isLogged()){
                       $avatar2 = 'hideavatar.jpg';
                       $hide_text = 'Billede kun synligt for medlemmer';
                   } else {
                       $avatar2 = $blogs[$i+1]->avatar;
                   }
                } else {
                   $avatar2 = 'noavatar'.$blogs[$i+1]->gender.'.jpg';
                }
                ?>
            <div>
                <h3 class="clearfix">
                    <div class="name"><?php echo $blogs[$i+1]->name;?><span style="margin-left: 3px;" id="online_blog_<?php echo ($i+1).'_'.$blogs[$i+1]->user_id;?>"></span></div>
                    <div class="clock"><?php echo get_time_difference_php($blogs[$i+1]->time);?></div>
                </h3>
                <div class="icon">
                    <a class="normalTip" <?php if($blogs[$i+1]->own){?>title="<?php echo $own[$blogs[$i+1]->own];?>"<?php }?>><img src="<?php echo base_url(); ?>assets/frontend/img/icon<?php echo $blogs[$i+1]->own;?>-2.png" alt=""/></a>
                </div>
                <div class="imgPeople2">
                    <a href="<?php echo $profile_link2;?>" <?php if(!isLogged()){?>data-reveal-id="f-errorPage"<?php }?> title="<?php echo $hide_text;?>">
                        <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$avatar2.'&w=47&h=70&q=70'; ?>" alt=""/>
                    </a>
                </div> 
                <a href="<?php echo $blog_detail2;?>" class="infoPeople2" <?php if(!isLogged()){?>data-reveal-id="f-errorPage"<?php }?>><?php echo implode(' ', array_slice(explode(' ', strip_tags($blogs[$i+1]->content)), 0, 10)).'...';?></a>
            </div>
            <?php }?>
        </li>
        <?php }?>
    </ul>
</div>