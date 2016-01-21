<?php 
$own = array(1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
$img = '';
if($user->avatar){
   $avatar = $user->avatar;
} else {
   $avatar = 'noavatar'.$user->gender.'.jpg';
}
$img = '<img src="'.base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$avatar.'&q=100&w=200&h=280" alt=""/>';
?>
<p class="id-profil"><?php echo $user->id;?> - <?php echo $own[$user->own]?><?php if(!$user->active) echo '<br />KONTO ER INAKTIV';?></p>
<span class="img-profil">
    <?php echo $img;?>
</span>
<div class="status-profil"><?php echo getUser()->slogan;?></div>
<ul class="list-func">
    <li><a href="<?php echo base_url().index_page(); ?>profiles/detail/<?php echo getUser()->id;?>/<?php echo getUser()->name;?>.html">Se min Profil</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>user/photo.html" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Mine Billeder (<b style="color:red;"><?php echo $photo_quantity;?></b>)</a></li>
    <li><a href="<?php echo base_url().index_page();?>profiles/message.html">Mine beskeder <?php if($num) echo '(<b style="color:red;">'.$num.'</b>)'?></a></li>
    <li><a href="<?php echo base_url().index_page(); ?>user/blog.html" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Mine blogs</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>user/datinglist.html">Mine VIP/Date opslag</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>user/dating.html" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Du skal på date! (<b style="color:#ff0000;"><?php echo $anmodning;?></b>)</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>user/datingvip.html" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>VIP Invitation (<b style="color:#ff0000;"><?php echo $vip;?></b>)</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>user/friend.html" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Mine Kontaktpersoner</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>user/request.html" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Venne anmodninger <?php if($request_num) echo '(<b style="color:red;">'.$request_num.'</b>)'?></a></li>
</ul>
<ul class="whoSeeme">
    <p>Hvem har set mig (<?php echo $view_quantity;?>)</p>
    <?php $i=1; if($views){ foreach($views as $friend){
        $profile_link = base_url().index_page()."profiles/detail/".$friend->id."/".$friend->name.".html";
        ?>
        <li><a href="<?php echo $profile_link;?>" title="<?php echo $friend->name;;?>">
        <?php if($friend->avatar){?>
            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$friend->avatar.'&q=100&w=36&h=36'; ?>" alt=""/>
        <?php } else{ ?>
            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').'noavatar'.$friend->gender.'.jpg'.'&q=100&w=36&h=36'; ?>" alt=""/>
        <?php }?>
        </a></li>
    <?php $i++; }}?>
    <?php if($i<15){ for($i; $i<16; $i++){?>
    <li></li>
    <?php }}?>
</ul>
<div class="clear"></div>
<div class="box-border">
    <p><?php echo $user->description;?></p>
</div>