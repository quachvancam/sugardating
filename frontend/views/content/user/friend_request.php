<script type="text/javascript">
function checkstatus(data){
    //console.log(data); // To see output using Firebug
    if (data.s == 'available') {
        $("#online_"+data.id).append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconchop.gif" style="margin-right:0px" />');
    } else {
        $("#online_"+data.id).append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconDoc-Red.png" style="margin-right:0px"  />');
    }
}
window.onload = function() {
    <?php foreach($requests as $request){?>
    jqcc.cometchat.getUser('<?php echo $request->id;?>','checkstatus');
    <?php }?>
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
                        <h2 class="f-l w250">Venne anmodninger</h2>
                        <div class="clear"></div>
                        <p style="color:#5e5e5e">Endnu ingen venneanmodninger. Prøv at sende dine egne venneanmodninger, og se hvad der sker...</p>
                        <ul class="request-friend">
                            <?php foreach($requests as $request){
                                $profile_link = base_url().index_page()."profiles/detail/".$request->id."/".$request->name.".html";
                                $accept_link = base_url().index_page()."user/accept_request/".$request->id."/".$request->name.".html";
                                $reject_link = base_url().index_page()."user/reject_request/".$request->id."/".$request->name.".html"; 
                            ?>
                            <li>
                                <div style="padding: 5px 0 0 0;">
                                    <div class="w235">
                                        <div class="f-l" style="margin-right: 2px;">
                                            <a href="<?php echo $profile_link;?>" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>
                                            <?php if($request->avatar){?>
                                            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$request->avatar.'&q=100&w=29&h=29'; ?>" alt=""/>
                                            <?php }else{?>
                                                <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').'noavatar'.$request->gender.'.jpg'.'&q=100&w=29&h=29'; ?>" alt=""/>
                                            <?php }?>
                                            </a>
                                        </div>
                                        <div class="f-l" style="width: 200px;">
                                            <p><span class="userName"><a href="<?php echo $profile_link;?>" class="f-l" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>><b><?php echo $request->name;?></b></a></span> <span id="online_<?php echo $request->id;?>" class="f-l" style="vertical-align:middle; margin-left: 5px;"></span> </p>
                                            <div class="clear"></div>
                                            <div style="float: right;"><a style="color:#969696;" href="<?php echo $accept_link;?>">acceptér</a> <span style="color:#969696;">|</span> <a style="color:#969696;" href="<?php echo $reject_link;?>">afvis</a></div>
                                            <div class="clear"></div>
                                        </div>
                                        <!--div class="btn-accept"><a href="<?php echo $accept_link;?>">acceptér</a> | <a href="<?php echo $reject_link;?>">afvis</a></div-->
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?>
</div>