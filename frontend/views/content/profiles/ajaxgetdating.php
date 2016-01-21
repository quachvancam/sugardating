<div class="block">
    <label>Vælg: Date opslag kategori</label>
    <select class="w117" id="category_id">
        <option value="0">Alle</option>
        <?php echo $category_block;?>
    </select>
</div>
<div class="block">
    <label>Jeg er</label>
    <select class="w117" id="own">
        <option value="0">Alle</option>
        <?php echo $own_block;?>
    </select>
</div>
<div class="block">
    <label>Og søger</label>
    <select class="w147" id="play">
        <option value="0">Alle</option>
        <?php echo $play_block;?>
    </select>
</div>
<a class="bntSearch" href="javascript:searchDating();">Go</a>
<?php if($datings){ ?>
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
    <div class="resultDO clearfix">
        <ul>
        <?php
            $html = "";
            #echo "<pre>";
            #print_r($datings);
            foreach($datings as $dating){
                if(isLogged()){
                    $profile_link = base_url().index_page().'profiles/detail/'.$dating['id'].'/'.$dating['name'].'.html';
                    $dating_link = base_url().index_page().'profiles/datingdetail/'.$dating['dating_id'].'/'.$dating['alias'].'.html';
                    if(member_type()==1){
                        $apply_dating = 'data-reveal-id="f-upgradePage"';
                    }
                    else{
                        $apply_dating = 'onclick="applyDating('.$dating['dating_id'].');"';
                    }
                    $data_reveal = '';
                    if(checkApplyDating($dating['dating_id'],$user->id)){
                        $link = '<a class="tooltip" style="float: right;height: 23px;margin: 3px 0 0 20px; width: 85px;" href="javascript:void(0);">
                                    <span>Anvendt</span><img src="'.base_url().'assets/frontend/img/btnSeeyou2.png" />
                                </a>';
                    }else if($user->id == $dating['user_id']){
                        $link = '<a class="tooltip" style="float: right;height: 23px;margin: 3px 0 0 20px; width: 85px;" href="javascript:void(0);">
                                    <span>Min Dating</span><img src="'.base_url().'assets/frontend/img/btnSeeyou2.png" />
                                </a>';
                    }else{
                        $link = '<a '.$apply_dating.' class="bntSes" href="javascript:void(0);" '.$data_reveal.'>SES VI?</a>';
                    }
                }
                else {
                    $profile_link = 'javascript:void(0);';
                    $dating_link = 'javascript:void(0);';
                    $apply_dating = '';
                    $data_reveal = 'data-reveal-id="f-errorPage"';
                    $link = '<a '.$apply_dating.' class="bntSes" href="javascript:void(0);" '.$data_reveal.'>SES VI?</a>';
                }
                if($dating['avatar']){
                   if($dating['hide_avatar'] && !isLogged()){
                       $avatar = 'hideavatar.jpg';
                       $hide_text = '<span>Billede kun synligt for medlemmer</span>';
                   } else {
                       $avatar = $dating['avatar'];
                       $hide_text = '';
                   }
                } else {
                   $avatar = 'noavatar'.$dating['gender'].'.jpg';
                   $hide_text = '';
                }
                $img = '<img src="'.base_url().'thumbnail/timthumb.php?src='.base_url().'upload/user/'.$avatar.'&w=120&h=170&q=80" alt=""/>';
                
                $left_time = $dating['end_date'] - time();
                                        
                if($left_time > 60){
                    $days = intval($left_time/24/60/60);
                    $remain = $left_time % 86400;
                    $hours = intval($remain/3600);
                    $remain = $remain % 3600;
                    $mins = intval($remain/60);
                }
                $type = array(1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
                $html .= '
                    <li>
                    	<div class="infoLeft">
                        	<div class="imgPeople3">
                            	<a class="tooltip" href="'.$profile_link.'" '.$data_reveal.'>'.$hide_text.''.$img.'</a>
                            </div>
                            <div class="infoContent">
                            	<h3 style="width: 115px;height: 22px; overflow: hidden;">'.$dating['name'].'</h3>
                                <span>Alder: '.get_age($dating['day'], $dating['month'], $dating['year']).' år</span>
                                <span>Højde: '.$dating['height'].' cm</span>
                                <span>Vægt: '.$dating['weight'].' kg</span>
                                <span>Postnr: '.$dating['code'].'</span>
                                <span>By: '.$dating['city'].'</span>
                            </div>
                        </div>
                        <div class="infoRight">
                            <div style="float:left;"><img src="'.base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_deal_category_path').$dating['white_icon'].'&q=100&w=33&h=33"/></div>
                        	<a style="width: 180px; height: 45px; overflow: hidden;" href="'.$dating_link.'" '.$data_reveal.' class="titlePeo">'.$dating['title'].'</a>
                            <div class="clear"></div>
                            <div class="timer">
                            	<p class="timerDetail">'.$days.' dage '.$hours.' timer '.$mins.' min</p>
                                <span class="s10">inden sugar daten udløber</span>
                            </div>
                            <a href="'.$dating_link.'" '.$data_reveal.'>'.implode(' ', array_slice(explode(' ', $dating['description']), 0, 10)).'...'.'</a>
                            <div class="icon2">
                              <a class="tooltip" style="height: 28px; display:block;"><span>'.$type[$dating['own']].'</span><img src="'.base_url().'assets/frontend/img/icon'.$dating['own'].'.png"/></a>
                              <a class="tooltip" title=""  style="height: 18px; display:block;"> <span>'.$type[$dating['play']].'</span><img src="'.base_url().'assets/frontend/img/icon'.$dating['play'].'-1.png" /></a>
                            </div>
                        </div>
                        <div class="status3 clearfix">'.get_order_category($dating['id']).' '.$link.'</div>
                    </li>
                ';
            }
            echo $html;
        ?>
        </ul>
    </div>
    <div class="pagging clear">
        <?php echo $next;?>
        <ul>
        <?php if($page_num>1){
            for($i=1; $i<=$page_num; $i++){
                $current = $page==$i?'class="current"':'';
                echo '<li '.$current.'><a href="javascript:moreDating('.$i.');">'.$i.'</a></li>';
            }
        }?>
        </ul>
        <?php echo $prev;?>
    </div>
<?php }else{ ?>
    <div class="resultDO clearfix">Ingen resultater</div>
<?php }?>