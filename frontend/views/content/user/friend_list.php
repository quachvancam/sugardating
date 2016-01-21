<?php $i=1;?>
<script type="text/javascript">
function checkstatus(data){
    if (data.s == 'available') {
        $("#online_"+data.id).append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconchop.gif" style="margin-right:0px" />');
    } else {
        $("#online_"+data.id).append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconDoc-Red.png" style="margin-right:0px"  />');
    }
}
window.onload = function() {
    <?php foreach($friends as $friend){?>
    jqcc.cometchat.getUser('<?php echo $friend->id;?>','checkstatus');
    <?php }?>
}
function remove_friend(id){
    var r = confirm("Ønsker du at fjerne denne ven?");
    if (r == true){
        location.href = '<?php echo base_url().index_page()?>user/remove_friend/'+id;
    }
}
</script>
<div class="clearfix bgContent m-t-3" id="sugarDates">
    <div class="contentLeft">
        <div class="col-profil clearfix">
            <?php echo modules::run('own/own/left_content'); ?>
        </div>
        <div class="infoProfil clearfix">
            <div class="profilowner">
                <div class="bloger m-b20 clearfix">
                    <div class="clear"></div>
                    <div class="blogerComment clearfix">
                        <h2 class="f-l w250">Mine Kontakter</h2>
                        <div class="clear"></div>
                        <?php if($friends){?>
                        <ul class="request-friend">
                            <?php foreach($friends as $friend){
                                $profile_link = base_url().index_page()."profiles/detail/".$friend->id."/".$friend->name.".html";
                                //$remove_link = base_url().index_page()."user/remove_friend/".$friend->id."/".$friend->name.".html"; 
                                $tmp = $i%4;
                                if($tmp == 1 || $tmp == 2){
                                    $style = 'style="background:none repeat scroll 0 0 #230708;"';
                                } else {
                                    $style = 'style="background:none repeat scroll 0 0 #1C0E0E;"';
                                }
                            ?>
                            <li <?php echo $style;?>>
                                <div style="padding: 5px 0 0 0;">
                                    <div class="w235">
                                        <div class="f-l" style="margin-right: 2px;">
                                            <a href="<?php echo $profile_link;?>" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>
                                            <?php if($friend->avatar){?>
                                            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$friend->avatar.'&q=100&w=29&h=29'; ?>" alt=""/>
                                            <?php }else{?>
                                                <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').'noavatar'.$friend->gender.'.jpg'.'&q=100&w=29&h=29'; ?>" alt=""/>
                                            <?php }?>
                                            </a>
                                        </div>
                                        <div class="f-l" style="width: 200px;">
                                            <p><span class="userName"><a href="<?php echo $profile_link;?>" class="f-l" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>><b><?php echo $friend->name;?></b></a></span> <span id="online_<?php echo $friend->id;?>" class="f-l" style="vertical-align:middle; margin-left: 5px;"></span> </p>
                                            <div class="clear"></div>
                                            <div style="float: right;"><a style="color:#969696;" href="javascript:remove_friend(<?php echo $friend->id;?>);">fjern</a></div>
                                            <div class="clear"></div>
                                        </div>
                                        <!--div class="btn-accept"><a href="javascript:remove_friend(<?php echo $friend->id;?>);">fjern</a></div-->
                                        <div class="clear"></div>
                                    </div>
                                </div> 
                            </li>
                            <?php }?>
                        </ul>
                        <?php }else{?>
                            <p style="color:#5e5e5e">Endnu ingen kontakter. Prøv at sende dine egne Venneanmodninger!</p>
                        <?php }?>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?>
</div>