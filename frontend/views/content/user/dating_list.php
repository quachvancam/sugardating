<?php 
$ci =& get_instance();
$ci->load->database();
?>
<div class="clearfix bgContent m-t-3" id="sugarDates">
    <div class="contentLeft">
        <div class="col-profil clearfix"> <?php echo modules::run('own/own/left_content'); ?> </div>
        <div class="infoProfil clearfix">
            <div class="profilowner">
                <div class="bloger m-b20 clearfix">
                    <h2 style="color: #ffffff;">Mine VIP/Date opslag</h2>
                    <div class="clear"></div>
                    <div class="blogerComment clearfix">
                        <div class="resultDO clearfix experiences" style="margin-top: 0px;">
                            <ul>
                                <?php 
                                if($datings){ foreach($datings as $dating){
                                    if($dating->order_item_id){
                                        $ci->db->select('dc.white_icon, d.name, d.id');
                                        $ci->db->from('deal_category dc');
                                        $ci->db->join('order_item oi', 'oi.category_id = dc.id');
                                        $ci->db->join('deal d', 'd.id = oi.deal_id');
                                        $ci->db->where('oi.id', $dating->order_item_id);
                                        $result = $ci->db->get();
                                        $row = $result->row();
                                        
                                        if($row){
                                            $white_icon = $row->white_icon;
                                            $dealName = $row->name;
                                            $dealID = $row->id;
                                        }
                                        else{
                                            $white_icon = '724b7666efdbb68edbf7c7cd9233216c.png';
                                            $dealName = "Ingen deal";
                                            $dealID = "";
                                        }  
                                    } else {
                                        $white_icon = '724b7666efdbb68edbf7c7cd9233216c.png';
                                        $dealName = "Ingen deal";
                                        $dealID = "";
                                    }
                                    $detail_link = base_url().index_page().'user/datingdetail/'.$dating->id.'/'.$dating->alias.'.html';
                                    $edit_link = base_url().index_page().'user/editdating/'.$dating->id.'/'.$dating->alias.'.html';
                                    $left_time = $dating->end_date - time();

                                    if($left_time > 60){
                                        $days = intval($left_time/24/60/60);
                                        $remain = $left_time % 86400;
                                        $hours = intval($remain/3600);
                                        $remain = $remain % 3600;
                                        $mins = intval($remain/60);
                                    }
                                ?>
                                <li>
                                    <div class="infoRight">
                                        <div style="min-height: 50px;">
                                            <div class="question-mark2" style="float:left; margin: 0 3px;">
                                                <img alt="" src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_deal_category_path').$white_icon.'&q=100&w=33&h=33'; ?>" style="float:left;"/>
                                                <div class="common-popup">
                                                    <div class="top"><span class="arrow"></span></div>
                                                    <div class="content">
                                                        <?php if($dealID){?>
                                                        <a style="color: #ffffff; font-size: 13px;" href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $dealID."/".seo_url($dealName);?>.html"><?php echo $dealName;?></a>
                                                        <?php }else{?>
                                                            <p style="color: #ffffff; font-size: 13px;"><?php echo $dealName;?></p>
                                                        <?php }?>
                                                    </div>
                                                    <div class="bottom"></div>
                                                </div>
                                            </div>
                                            <a style="width: 200px;" href="<?php echo $detail_link;?>" class="titlePeo"><?php echo $dating->title;?></a>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="timer">
                                            <?php if($left_time > 0){?>
                                            <p class="timerDetail"><?php echo $days;?> dage <?php echo $hours;?> timer <?php echo $mins;?> min</p>
                                            <span class="s10">inden sugar daten udløber</span> 
                                            <?php } else {?>
                                            <p class="timerDetail">Udløbet</p>
                                            <?php }?>
                                        </div>
                                        <div style="min-height: 50px;">
                                            <?php echo implode(' ', array_slice(explode(' ', $dating->description), 0, 10)).'...';?>
                                        </div>
                                    </div>
                                    <div class="status3 clearfix">
                                        <?php if($left_time > 0){?>
                                        <a href="javascript:void(0);" style="margin-top:3px; float: left;"><img src="<?php echo base_url();?>assets/frontend/img/btnEdit_gray.jpg" /></a>
                                        <?php } else {?>
                                        <a href="<?php echo $edit_link;?>" style="margin-top:3px; float: left;"><img src="<?php echo base_url();?>assets/frontend/img/btnEdit.jpg" /></a>
                                        <?php }?>
                                        
                                        <a href="<?php echo $detail_link;?>" style="margin-top:3px; float: left;"><img src="<?php echo base_url();?>assets/frontend/img/btnSeedetail.jpg" /></a>
                                        <a style="margin-top:3px; padding: 3px 15px 0 15px; background: #640c0c; display: inline; height: 21px; float:right;" href="<?php echo base_url().index_page();?>user/sletdating/<?php echo $dating->id;?>.html">Slet</a>
                                        
                                        <div class="clear"></div>
                                    </div>
                                </li>
                                <?php } }?>
                            </ul>
                        </div>
                        <?php echo $all_link;?>
                    </div>
                    <!--.blogerComment--> 
                </div>
                <!--.bloger--> 
            </div>
            
            <div>
            <a href="<?php echo base_url().index_page(); ?>user/adddating.html" class="bt-createdating" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Opret nyt VIP/Date opslag</a> 
            </div>
            <!--.profilowner--> 
        </div>
        <!--.info-profil--> 
    </div>
    <!--contentLeft--> 
    <?php echo modules::run('banner/banner/index'); ?> 
    <!--adsRight--> 
</div>