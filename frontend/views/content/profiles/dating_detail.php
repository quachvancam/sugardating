<div id="sugarDates" class="clearfix bgContent m-t-3">
    <div class="contentLeft">
    <script type="text/javascript">
    function applyDating(id){
        $.ajax({
        	type: 'post',
        	url: '<?php echo base_url().index_page();?>profiles/applyDating.html',
            data: {id: id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
        	success:function (result){
                $('#alert').html('Din date anmodning er nu sendt');
                $('#backoverlay').show();
                $('#show_popup').show();
        	}			
        });
    }
    </script>
    <div class="col-profil clearfix">
        <?php echo modules::run('profile/left_content',$dating->id); ?>
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
        if(isLogged()){
            if(member_type()==1){
                $apply_dating = 'data-reveal-id="f-upgradePage"';
            }
            else{
                $apply_dating = 'onclick="applyDating('.$dating->dating_id.');"';
            }
            $data_reveal = '';
            if(checkApplyDating($dating->dating_id,$user->id)){
                $link = '<a class="tooltip" style="float: right;" href="javascript:void(0);">
                            <span>Anvendt</span><img src="'.base_url().'assets/frontend/img/btnSeeyou.png" />
                        </a>';
            }else if($user->id == $dating->id){
                $link = '<a class="tooltip" style="float: right;" href="javascript:void(0);">
                            <span>Min Dating</span><img src="'.base_url().'assets/frontend/img/btnSeeyou.png" />
                        </a>';
            }
            else{
                $link = '<a '.$apply_dating.' class="bntSeeyou" href="javascript:void(0);" '.$data_reveal.'>SES VI?</a>';
            }
        }
        else {
            $apply_dating = '';
            $data_reveal = 'data-reveal-id="f-errorPage"';
            $link = '<a '.$apply_dating.' class="bntSeeyou" href="javascript:void(0);" '.$data_reveal.'>SES VI?</a>';
        }
        ?>
    </div>
    <div class="movieDate clearfix">
      <div class="editDate"></div>
      <div class="clear"></div>
      <div class="w-letMovie">
        <div class="letMovie-top clearfix">
          <h2>
              <img src="<?php echo base_url();?>thumbnail/timthumb.php?src=<?php echo base_url().get_config_value('upload_deal_category_path').$white_icon?>&q=100&w=55&h=55"/>
              <?php echo $dating->title;?>
          </h2>
          <div class="icon2">
              <a class="tooltip" style="height: 28px; display:block;"><span><?php echo $type[$dating->own];?></span><img src="<?php echo base_url();?>assets/frontend/img/icon<?php echo $dating->own;?>.png"/></a>
              <a class="tooltip" style="height: 18px; display:block;"> <span><?php echo $type[$dating->play];?></span><img src="<?php echo base_url();?>assets/frontend/img/icon<?php echo $dating->play;?>-1.png" /></a>
          </div>
        </div>
        <div class="letMovie-bottom clearfix">
            <div class="datetime">
                <p><?php echo $days;?> dage <?php echo $hours;?> timer <?php echo $mins;?> min</p>
                <span>til date opslaget udløber</span>
            </div>
            <?php echo $link;?>
        </div>
      </div>
      <div class="w-interested2 m-t10 clearfix">
        <div class="description2">
            <?php echo $dating->description;?>
        </div>
      </div>
    </div>

  </div>
  <?php echo modules::run('banner/banner/index'); ?> 
</div>
<?php echo modules::run('shop/shop/index'); ?>