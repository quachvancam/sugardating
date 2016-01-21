<?php 
$own = array(1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
$i = 1;
?>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('#message').bind("enterKey",function(e){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().index_page();?>profiles/ajax_save_message.html",
            data: { message: $("#message").val(), from_id: $("#from_id").val(), to_id: $("#to_id").val(), '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        }).done(function( html ) { 
            jQuery(".w-comment").prepend(html);
            jQuery("#message").val("");
        });
    });
    jQuery('#message').keyup(function(e){
        if(e.keyCode == 13)
        {
            jQuery(this).trigger("enterKey");
        }
    });
    jQuery('.bntSendmes').bind("click",function(e){jQuery('#message').trigger("enterKey")});  
    
    jQuery(".bntSeemore").click(function(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().index_page();?>profiles/ajax_load_more_messages.html",
            data: { offset: $("#offset").val(), to_id: $("#to_id").val(),'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        }).done(function( html ) { 
            if(html){
                jQuery(".w-comment").append(html);
                $("#offset").val(parseInt($("#offset").val())+10);
            } else {
                alert('Aktiviteten slutter');
            }
        });
    }); 
});
function checkstatus(data){
    //console.log(data); // To see output using Firebug
    if (data.s == 'available') {
        $("#online").append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconDoc-Green.png" />');
    } else {
        $("#online").append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconDoc-Red.png" />');
    }  
}
window.onload = function() {
    jqcc.cometchat.getUser('<?php echo $user->id;?>','checkstatus');
}
</script>
<div class="clearfix bgContent" id="sugarDates">
    <div class="contentLeft"> 
        <div class="col-profil clearfix">
            <?php echo modules::run('own/own/left_content'); ?>
        </div>
        <div class="infoProfil clearfix">
            <div class="messView">
                <div class="topMV m-t30">
                    <div class="imgUser">
                        <a href="<?php echo base_url().index_page().'profiles/detail/'.$user->id.'/'.$user->name.'.html'; ?>">
                        <?php if($user->avatar){?>
                        <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$user->avatar.'&q=100&w=35&h=35'; ?>" alt=""/>
                        <?php }else{?>
                        <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').'noavatar'.$user->gender.'.jpg'.'&q=100&w=35&h=35'; ?>" alt=""/>
                        <?php }?>
                        </a>
                    </div>
                    <p><a style="color:#edcc7c;" href="<?php echo base_url().index_page().'profiles/detail/'.$user->id.'/'.$user->name.'.html'; ?>">Leger med <?php echo $user->name;?></a> <span id="online"></span></p>
                    <div class="gender2"><a class="normalTip" title="<?php echo $own[$user->own];?>"><img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/icon<?php echo $user->own;?>-2.png"/></a></div>
                </div>
                <div class="w-mess">
                    <div class="iconhaft2"></div>
                    <input type="text" value="Skriv din besked her" name="message" id="message"/>
                    <input type="hidden" name="attach_dating" id="attach_dating" value="0" />
                    <input type="hidden" name="from_id" id="from_id" value="<?php echo getUser()->id;?>" />
                    <input type="hidden" name="to_id" id="to_id" value="<?php echo $user->id;?>" />
                    <a href="javascript:void(0);" class="bntSendmes f-r">Send besked</a>
                    <div style="clear:both;"></div>
                </div>
                <div class="w-comment">
                    <?php foreach($messages as $message){
                        if(!$message->attach_dating){
                    ?>
                    <div class="comItem <?php if($message->from_id == getUser()->id) echo 'dark'; else echo 'light';?> clearfix">
                        <div class="f-l" style="width:180px;">
                            <p><?php echo $message->name;?></p>
                            <span><?php echo get_time_difference_php($message->time);?></span> </div>
                        <div class="f-r" style="width: 300px;">
                            <p><?php echo $message->message;?></p>
                        </div>
                    </div>
                    <?php } else {
                        }
                        $i++;
                    }?>
                </div>
                <div class="bntSeemore m-t10"><a href="javascript:void(0);"><img alt="Se mere" style="vertical-align: inherit;" src="<?php echo base_url(); ?>/assets/frontend/img/seemore.png" /></a></div>
                <input type="hidden" id="offset" value="<?php echo 10;?>" />
                
            </div>
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?> 
    <div class="clear"></div>
</div>