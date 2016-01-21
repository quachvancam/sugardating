<?php
if($user->avatar){
   $avatar = $user->avatar;
} else {
   $avatar = 'noavatar'.$user->gender.'.jpg';
}
$img = '<img src="'.base_url().'thumbnail/timthumb.php?src='.base_url().'upload/user/'.$avatar.'&w=110&h=150&q=100" alt=""/>';
?>
<div class="logined">
    <div class="imgUser" style="height: 150px;">
        <a href="<?php echo base_url().index_page();?>user/owner.html">
            <?php echo $img;?>
        </a>
    </div>
    <h3><a href="<?php echo base_url().index_page();?>user/owner.html">Hej <?php echo $user->name;?> :)</a></h3>
    <img src="<?php echo base_url();?>upload/system/<?php echo $user->member;?>.png" style="margin:5px 0" />
    <ul class="listInfo">
        <li><a href="<?php echo base_url().index_page();?>user/owner.html">Min Profil</a></li>
        <li><a href="<?php echo base_url().index_page();?>profiles/message.html">Mine beskeder <?php if($num) echo '(<b style="color:red;">'.$num.'</b>)'?></a></li>
        <li><a href="<?php echo base_url().index_page();?>user/owner.html">Min Sugar Box</a></li>
        <li><a href="<?php echo base_url().index_page();?>user/owner.html#se-hvad-der-sker" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Se hvad der sker </a></li>
    </ul>
</div>