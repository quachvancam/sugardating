<?php 
$own = array(1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
$i = 1;
?>
<script type="text/javascript">
function checkstatus(data){
    //console.log(data); // To see output using Firebug
    if (data.s == 'available') {
        $("#online_"+data.id).append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconchop.gif" class="f-l" style="vertical-align:middle; margin-left: 5px; margin-top: 5px;" />');
    } else {
        $("#online_"+data.id).append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconDoc-Red.png" class="f-l" style="vertical-align:middle; margin-left: 5px; margin-top: 5px;" />');
    }
}
window.onload = function() {
    <?php foreach($users as $user){?>
    jqcc.cometchat.getUser('<?php echo $user->id;?>','checkstatus');
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
                        <h2 class="f-l w250">Mine Beskeder</h2>
                        <div class="clear"></div>
                        <div class="my-post">
                            <?php if($users){ foreach($users as $user){
                                $profile_link = base_url().index_page().'profiles/detail/'.$user->id.'/'.$user->name.'.html';
                                $message_link = base_url().index_page().'profiles/chat/'.$user->id.'/'.$user->name.'.html';
                            ?>
                            <div class="commentItem <?php if($i%2==0) echo 'light-brown';?>">
                                <div class="f-l w500" style="position: relative;">
                                    <a href="<?php echo $profile_link;?>" class="message_avatar" style="float: left;">
                                        <?php if($user->avatar){?>
                                        <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$user->avatar.'&q=100&w=29&h=29'; ?>" alt=""/>
                                        <?php }else{ ?>
                                        <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').'noavatar'.$user->gender.'.jpg'.'&q=100&w=29&h=29'; ?>" alt=""/>
                                        <?php }?>
                                    </a>
                                    <div class="f-l" style="width: 180px;">
                                        <p><span class="userName"><a href="<?php echo $profile_link;?>" class="f-l"><?php echo $user->name;?></a></span> <span id="online_<?php echo $user->id;?>"></span><?php if($user->not_seen) echo '(<b style="color:red;">'.$user->not_seen.'</b>)'?></p>
                                        <div class="clear"></div>
                                        <p><?php echo get_time_difference_php($user->message_time);?></p>
                                    </div>
                                    <a href="<?php echo $message_link;?>" class="message-more"><?php echo $user->message;?></a>
                                    <a style="background: #640c0c; display: inline; padding: 5px 15px; position: absolute; top: 2px; right: 5px;" href="<?php echo base_url().index_page().'profiles/deletemessage/'.$this->session->userdata('userid').'/'.$user->id.'/'.$user->name.'.html';?>">Slet</a>
                                </div>
                            </div>
                            <?php $i++;}}?>
                        </div>
                        <div class="clear"></div>
                        <div class="bntSeemore"><a href="javascript:void(0);"><img alt="Se mere" style="vertical-align: inherit;" src="<?php echo base_url(); ?>/assets/frontend/img/seemore.png" /></a></div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <?php echo modules::run('banner/banner/index'); ?>
</div>