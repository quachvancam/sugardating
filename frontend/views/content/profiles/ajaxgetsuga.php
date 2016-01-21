<div class="search_results2 clearfix">
    <div class="fl w225" style="width: 245px;">
        <label for="">Alder</label>
        <?php echo $min_old_block.$max_old_block; ?>
    </div>
    <div class="fl w225" style="width: 245px;">
        <label for="">Højde</label>
        <?php echo $min_height_block.$max_height_block; ?>
    </div>
    <div class="fl w225">
        <label for="">Vægt</label>
        <?php echo $min_weight_block.$max_weight_block; ?>
    </div>
    <div class="clear mb10"></div>
    <?php echo $min_post_block.$max_post_block; ?>
    <a onclick="searchSugar<?php echo $id;?>();" href="javascript:void(0);" class="btnSearch fl">Search</a>
    <div class="clear"></div>
    <div class="results clearfix">
    <?php if($sugars){?>
        <div class="resultSD clearfix">
        <ul>
        <?php
        foreach($sugars as $user){
            if(isLogged()){
               $profile_link = base_url().index_page()."profiles/detail/".$user->id."/".$user->name.".html";
            } else {
               $profile_link = "javascript:void(0);";
            }
            $data_reveal = '';
            if(!isLogged()){
                $data_reveal = 'data-reveal-id="f-errorPage"';
            }
            if($user->avatar){
               if($user->hide_avatar && !isLogged()){
                   $avatar = 'hideavatar.jpg';
                   $hide_text = '<span>Billede kun synligt for medlemmer</span>';
               } else {
                   $avatar = $user->avatar;
                   $hide_text = "";
               }
            } else {
               $avatar = 'noavatar'.$user->gender.'.jpg';
               $hide_text = "";
            }
            $img = '<img src="'.base_url().'thumbnail/timthumb.php?src='.base_url().'upload/user/'.$avatar.'&w=60&h=90&q=60" alt=""/>';
            
            if($user->member == 1){
                $type_img = '<img alt="" src="'.base_url().'assets/frontend/img/member_silver.png">';
            } else {
                $type_img = '<img alt="" src="'.base_url().'assets/frontend/img/member_gold.png">'; 
            }    
        ?>    
            <li>
                <div class="w-info">
                    <h3 style="color: rgb(237, 204, 124); font-size: 14px; margin-bottom: 3px; font-family: Source Sans Pro"><?php echo $user->name;?></h3>
                    <div class="imgPeople"><a class="tooltip" href="<?php echo $profile_link;?>" <?php echo $data_reveal;?>><?php echo $hide_text.''.$img;?></a>
                    <div class="iconSugar"><?php echo $type_img;?></div>
                    </div>
                    <div class="mainInfo">
                        Alder: <?php echo get_age($user->day, $user->month, $user->year);?> år<br/>
                        Højde: <?php echo $user->height;?> cm<br/>
                        Vægt: <?php echo $user->weight;?> kg<br/>
                        Postnr: <?php echo $user->code;?><br/>
                        By: <?php echo $user->city;?><br/>
                        <a href="<?php echo $profile_link;?>" <?php echo $data_reveal;?>> <?php echo $user->slogan;?></a>
                    </div>
                    <div class="femaleSymbol">
                        <a class="tooltip" style="height: 28px; display:block;">
                            <span><?php echo $own[$user->own];?></span><img src="<?php echo base_url();?>assets/frontend/img/icon<?php echo $user->own;?>.png"/>
                        </a>
                        <a class="tooltip" title=""  style="height: 18px; display:block;">
                            <span><?php echo $own[$user->play];?></span><img src="<?php echo base_url();?>assets/frontend/img/icon<?php echo $user->play;?>-1.png"/>
                        </a> 
                    </div>
                </div>
                <div class="status2"><?php echo get_order_category($user->id);?><a class="bntDetail" href="<?php echo $profile_link;?>" <?php echo $data_reveal;?>>Vis Mere !</a> </div>
            </li> 
        <?php }?>
        </ul>
        </div>
        <div class="pagging clear">
            <?php echo $next;?>
            <ul>
            <?php
            if($page_num>1){
                for($i=1; $i<=$page_num; $i++){
                    $current = $page==$i?'class="current"':'';
                    echo '<li '.$current.'><a href="javascript:'.$function.'('.$i.')">'.$i.'</a></li>';
                }
            }
            ?>
            </ul>
            <?php echo $prev;?>
        </div>
    <?php
    }else{?>
        Ingen resultater
    <?php }?>
    </div>
</div>