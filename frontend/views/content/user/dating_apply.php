<?php 
if($datingapply){ foreach($datingapply as $rows){
    if($rows->avatar){
        $avatar = $rows->avatar;
    } 
    else {
        $avatar = 'noavatar'.$rows->gender.'.jpg';
    }
    $img = '<img src="'.base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$avatar.'&q=100&w=35&h=35" alt=""/>';
    $profile_link = base_url().index_page().'profiles/detail/'.$rows->userid.'/'.$rows->name.'.html'; 
?>
<li>
  <div class="imgPeo">
    <a href="<?php echo $profile_link;?>"><?php echo $img;?></a>
  </div>
  <div class="infoPeo">
    <p style="width: 70px; font-size: 11px;"><a href="<?php echo $profile_link;?>"><?php echo $rows->name;?></a></p>
  </div>
  <?php if($rows->status == 1){?>
        <a class="bntAccept active" href="javascript:void(0);">Accepted</a>
  <?php }elseif($rows->status == -1){?>
        <a class="denial" href="javascript:void(0);">Afvis</a>
  <?php }?>
</li>
<?php }}?>