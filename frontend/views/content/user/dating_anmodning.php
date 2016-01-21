<div id="sugarDates" class="clearfix bgContent m-t-3">
  <div class="contentLeft">
   <div class="col-profil clearfix">
      <?php echo modules::run('own/own/left_content'); ?>
    </div>
    <div class="movieDate clearfix">
      <div class="w-letMovie">
        <h2>Du skal med på date!</h2>
        <div class="clear"></div>
        <?php if($datings){ foreach($datings as $rows){?>
        <div style="padding: 5px 0; border-bottom: 1px solid #231010;">
            <div class="letMovie-top clearfix">
                <div class="question-mark2" style="float:left; margin: 0 3px;">
                    <img src="<?php echo base_url();?>thumbnail/timthumb.php?src=<?php echo base_url().get_config_value('upload_deal_category_path').$rows['white_icon'];?>&q=100&w=33&h=33"/>
                    <div class="common-popup">
                        <div class="top"><span class="arrow"></span></div>
                        <div class="content">
                            <?php if($rows['dealID']){?>
                            <a style="color: #ffffff; font-size: 13px;" href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $rows['dealID']."/".seo_url($rows['dealName']);?>.html"><?php echo $rows['dealName'];?></a>
                            <?php }else{?>
                                <p style="color: #ffffff; font-size: 13px;"><?php echo $rows['dealName'];?></p>
                            <?php }?>
                        </div>
                        <div class="bottom"></div>
                    </div>
                </div>
                <div style="float: left; font-size: 18px;">
                    <h3><?php echo $rows['title'];?></h3>
                </div>
            </div>
            <div class="letMovie-bottom clearfix">
                <?php 
                $left_time = $rows['end_date'] - time();                        
                if($left_time > 60){
                    $days = intval($left_time/24/60/60);
                    $remain = $left_time % 86400;
                    $hours = intval($remain/3600);
                    $remain = $remain % 3600;
                    $mins = intval($remain/60);
                }
                ?>
                <div class="datetime">
                    <?php if($left_time > 0){?>
                    <p><?php echo $days;?> dage <?php echo $hours;?> time <?php echo $mins;?> min</p>
                    <span>til date opslaget udløber</span>
                    <?php } else {?>
                    <p style="height: 30px;">Udløbet</p>
                    <?php }?>
                </div>
                <div style="margin-left: 10px; float: left; width: 130px;">
                    <?php 
                        if($rows['avatar']){
                            $avatar = $rows['avatar'];
                        } 
                        else {
                            $avatar = 'noavatar'.$rows['gender'].'.jpg';
                        }
                        $img = '<img style="vertical-align: middle;" src="'.base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$avatar.'&q=100&w=35&h=35" alt=""/>';
                        $profile_link = base_url().index_page().'profiles/detail/'.$rows['userid'].'/'.$rows['name'].'.html'; 
                    ?>
                    <div style="float: left;">
                        <a href="<?php echo $profile_link;?>"><?php echo $img;?></a>
                    </div>
                    <div style="float: left; padding-left: 5px;">
                        <p style="width: 70px; font-size: 11px;"><a href="<?php echo $profile_link;?>"><?php echo $rows['name'];?></a></p>
                    </div>
                </div>
                <div style="float:right; font-size:15px; padding-top: 5px;">
                    <a style="background: #640c0c; border-radius:5px; display: inline; padding: 5px 15px; font-weight:bold;" href="<?php echo base_url().index_page();?>user/sletapply/<?php echo $rows['applyid'];?>.html">Slet</a>
                    <?php if($rows['status'] == 1){?>
                        <span style="color: #44da75; font-weight:bold;display: inline;"><img style="vertical-align: middle;" src="<?php echo base_url();?>assets/frontend/img/pub-ico.png" /> Godkendt</span>
                    <?php }elseif($rows['status'] == -1){?>
                        <p style="padding: 0 12px; color:#ffea17;font-weight:bold;display: inline;">Afvist</p>
                    <?php }else{?>
                        &nbsp;
                    <?php }?>
                </div>
            </div>
        </div>
        <?php }}else{?>
            <div>
                Ingen resultater!
            </div>
            <div style="padding: 20px 0;">
                <a href="javascript:void(0);" onclick="javascript:history.back();">
                    <img src="<?php echo base_url(); ?>assets/frontend/img/btn-back.jpg" />
                </a>
            </div>
        <?php }?>
      </div>
      <div class="description">
      </div>
    </div>
  </div>
  <?php echo modules::run('banner/banner/index'); ?> 
</div>
<?php echo modules::run('shop/shop/index'); ?>