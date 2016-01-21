<div id="sugarDates" class="clearfix bgContent m-t-3">
  <div class="contentLeft">
   <div class="col-profil clearfix">
      <?php echo modules::run('own/own/left_content'); ?>
    </div>
    <div class="movieDate clearfix">
      <div class="editDate"></div>
      <?php
        $type = array(1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
        $left_time = $dating->end_date - time();
        if($left_time > 60){
            $days = intval($left_time/24/60/60);
            $remain = $left_time % 86400;
            $hours = intval($remain/3600);
            $remain = $remain % 3600;
            $mins = intval($remain/60);
        }
      ?>
      <div class="clear"></div>
      <div class="w-letMovie">
        <div class="letMovie-top clearfix">
          <div style="font-size: 24px; font-family: 'lane_-_narrowregular';">
              <img src="<?php echo base_url();?>thumbnail/timthumb.php?src=<?php echo base_url().get_config_value('upload_deal_category_path').$datingIcon;?>&q=100&w=33&h=33"/>
              <?php echo $dating->title;?>
          </div>
          <div class="icon2">
              <a class="tooltip" style="height: 28px; display:block;"><span><?php echo $type[$user->own];?></span><img src="<?php echo base_url();?>assets/frontend/img/icon<?php echo $user->own;?>.png"/></a>
              <a class="tooltip" style="height: 18px; display:block;"> <span><?php echo $type[$user->play];?></span><img src="<?php echo base_url();?>assets/frontend/img/icon<?php echo $user->play;?>-1.png" /></a>
          </div>
        </div>
        <div class="letMovie-bottom clearfix">
            <?php if($left_time > 0){?>
            <div class="datetime" style="height: 30px;">
            <p><?php echo $days;?> dage <?php echo $hours;?> time <?php echo $mins;?> min</p>
            <span>til date opslaget udløber</span>
            </div>
            <?php } else {?>
            <div class="datetime" style="height: 30px;">
            <p>Udløbet</p>
            </div>
            <?php }?>
        </div>
      </div>
      <div class="w-interested2 m-t10 clearfix">
        <div class="f-l w313">
          <div class="voucher2">
                &nbsp;
          </div>
          <div class="description2">
                <?php echo $dating->description;?>
          </div>
        </div>
        <div class="f-r w178">
            <script type="text/javascript">
            function acceptDating(dating, user){
                $.ajax({
                	type: 'post',
                	url: '<?php echo base_url().index_page();?>user/acceptDating.html',
                    data: {dating: dating, user: user, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
                	success:function (result){
                        $('#showlistdating').html(result);
                	}			
                });
            }
            </script>
            
            <?php if($dating->uservip){?>
            <h2>Invitér en VIP bruger?</h2>
            <div class="clear"></div>
              <ul class="listIntersted clearfix">
                <?php 
                if($userVip){
                    if($userVip->avatar){
                        $avatar = $userVip->avatar;
                    } 
                    else {
                        $avatar = 'noavatar'.$userVip->gender.'.jpg';
                    }
                    $img = '<img src="'.base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$avatar.'&q=100&w=35&h=35" alt=""/>';
                    $profile_link = base_url().index_page().'profiles/detail/'.$userVip->id.'/'.$userVip->name.'.html'; 
                ?>
                <li>
                  <div class="imgPeo">
                    <a href="<?php echo $profile_link;?>"><?php echo $img;?></a>
                  </div>
                  <div class="infoPeo">
                    <p style="width: 70px; font-size: 11px;"><a href="<?php echo $profile_link;?>"><?php echo $userVip->name;?></a></p>
                  </div>
                    <?php if($dating->publish == 1){?>
                        <a class="denial" href="javascript:void(0);">Afvist</a>
                    <?php }else{?>
                        <?php if($dating->used == 1){?>
                            <a class="bntAccept active" href="javascript:void(0);">Accepteret</a>
                        <?php }else{?>
                            <a class="denial" href="javascript:void(0);">Venter</a>
                        <?php }?>
                    <?php }?>
                </li>
                <?php }?>
              </ul>
            <?php }?>
            
            <h2>Hvem skal med?</h2>
            <div class="clear"></div>
            <ul id="showlistdating" class="listIntersted clearfix">
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
                    <a class="bntAccept active" href="javascript:void(0);">Accepteret</a>
              <?php }elseif($rows->status == -1){?>
                    <a class="denial" href="javascript:void(0);">Afvist</a>
              <?php }else{?>
                    <a class="bntAccept" onclick="acceptDating('<?php echo $dating->id;?>','<?php echo $rows->userid;?>');" href="javascript:void(0);">Acceptér!</a>
              <?php }?>
            </li>
            <?php }}?>
            </ul>
        </div>
      </div>
      <div style="padding: 20px 0;">
        <a href="<?php echo base_url().index_page().'user/datinglist.html';?>">
            <img src="<?php echo base_url(); ?>assets/frontend/img/btn-back.jpg" />
        </a>
      </div>
    </div>
  </div>
  <?php echo modules::run('banner/banner/index'); ?> 
</div>
<?php echo modules::run('shop/shop/index'); ?>