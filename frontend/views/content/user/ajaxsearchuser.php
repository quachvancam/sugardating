<?php if($menber){ ?>
<ul class="list_vipmember clearfix">
    <?php    
    $own = array(1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
    foreach($menber as $user){   
    $img = '';
    if($user->avatar){
       $avatar = $user->avatar;
    } else {
       $avatar = 'noavatar'.$user->gender.'.jpg';
    }
    $img = '<img src="'.base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$avatar.'&q=100&w=200&h=280" alt=""/>';       
    ?>
    <li>
    <?php echo $img;?>
    <article>
      <h4>Profilenavn: <?php echo $user->name;?></h4>
      <p>Profilenr. <?php echo $user->id;?> - <?php echo @$own[$user->own];?></p>
      <p>Alder: <?php echo get_age($user->day, $user->month, $user->year);?> år</p>
      <p>Højde: <?php echo $user->height;?> cm</p>
      <p>Vægt: <?php echo $user->weight;?> kg</p>
      <p>Postnr. & By: <?php echo $user->code;?> <?php echo $user->city;?></p>
      <a class="btnSeeprofile" onclick="addVip('<?php echo $user->id;?>');" href="javascript:void(0);">Profile</a>
    </article>
    <div class="clear"></div>
    </li>
<?php } ?>
</ul>
<?php } else{?>
    Ingen resultater!
<?php }?>