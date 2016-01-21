<?php 
$own = array(1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
if(member_type()==1){
    $edit_status_link = 'javascript:void(0);';
} else {
    $edit_status_link = base_url().index_page().'user/editstatus.html';
}
?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/fancybox/jquery.fancybox.js?v=2.1.3"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#txt-status').css('display','none');
    jQuery('#creat-stt').click( function(e){
        e.preventDefault();
        jQuery('#txt-status').slideToggle('slow');
    });
    jQuery("#foo3").carouFredSel({
		auto			: false,
		items	: 8,
		scroll	: {
			items			: 4,
			duration		: 1000,
			timeoutDuration	: 2000
		},
		prev			:'#foo3_prev',
		next			:'#foo3_next'
	});
    $('.fancybox').fancybox();
    $('.fancybox-buttons').fancybox({
        openEffect  : 'none',
        closeEffect : 'none',
        prevEffect : 'none',
        nextEffect : 'none',
        closeBtn  : true,
        helpers : {
            title : {
                type : 'inside'
            },
            buttons : {}
        },
        afterLoad : function() {
            this.title = 'Billede ' + (this.index + 1) + ' af ' + this.group.length + (this.title ? ' - ' + this.title : '');
            }
    });
    jQuery(".bntSeemore").click(function(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().index_page();?>user/ajax_load_more_activity.html",
            data: { offset: $("#offset").val(), '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        }).done(function( html ) { 
            if(html){
                jQuery(".blogerComment").append(html);
                $("#offset").val(parseInt($("#offset").val())+3);
            } else {
                alert('Aktiviteten slutter');
            }
        });
    });
});
$("#status_permission").val('<?php echo $user->status_permission;?>').prop('selected',true);
</script>
<div class="clearfix bgContent m-t-3" id="sugarDates">
    <div class="contentLeft">
        <div class="col-profil clearfix">
            <?php echo modules::run('own/own/left_content'); ?>
        </div>
        <div class="infoProfil clearfix">
            <div class="profilowner">
                <div class="topInfo">
                    <div class="f-l">
                        <h2><?php echo $user->name?></h2>
                        <div class="iconFind-Male f-l">
                            <a style="height: 28px; display:block;" class="normalTip" title="<?php echo $own[$user->own]?>">
                                <img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/icon<?php echo $user->own;?>.png"/>
                            </a>
                            <a style="height: 18px; display:block;" title="<?php echo $own[$user->play]?>" class="normalTip">
                                <img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/icon<?php echo $user->play;?>-1.png"/>
                            </a>
                        </div>
                        <div class="clear"></div>
                        <span>
                            Alder:  <?php echo get_age($user->day, $user->month, $user->year);?> år<br/>   
                            Højde: <?php echo $user->height;?> cm<br/>
                            Vægt: <?php echo $user->weight;?> kg<br/>
                            Postnr: <?php echo $user->code;?><br/>
                            By: <?php echo $user->city;?>
                        </span>
                        <img src="<?php echo base_url(); ?>/assets/frontend/img/bntMember<?php echo $user->member;?>.png" alt=""/>
                    </div>

                    <div class="f-r"> 
                    <a href="<?php echo base_url().index_page(); ?>user/editprofile.html" class="bntEditProfile">Redigér profilen</a> 
                    <a href="<?php echo $edit_status_link; ?>" class="bntPlayMC" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Leg med Chat mig</a> 
                    <a href="<?php echo base_url().index_page(); ?>user/adddating.html" class="addDating" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Leg med Sugar dates</a>
                    <a href="<?php echo base_url().index_page(); ?>user/addblog.html" class="btnNewblog" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Leg med Sugar dates</a>
                    </div>
                    <div class="clear"></div>
                </div>
                <!--.topInfo-->
                <div class="sugarBox">
                    <h2>Sugar Box <sup style="font-size: 16px;font-family: century gothic;">&reg;</sup></h2>
                    <ul class="sugarTitle">
                        <li style="margin-right:15px;"><a class="l1" href="<?php echo base_url().index_page();?>sugarshop/mypurchase/<?php echo getUser()->id;?>.html">Købte</a></li>
                        <li style="margin-right:180px;"><img src="<?php echo base_url(); ?>/assets/frontend/img/iconHeart-Gray_red.png" />Ønskeliste</li>
                    </ul>
                    <div class="clear"></div>
                    <?php echo modules::run('mbox/mbox/index', getUser()->id); ?>
                </div>
                <!--.sugarBox-->
                <div class="myPhoto bor-b clearfix">
                    <h2 class="f-l">Mine billeder</h2>
                    <h6 style="padding-top:5px;" class="f-r" id="upfile1"><a href="<?php echo base_url().index_page(); ?>user/addphoto.html" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Tilføj billeder</a></h6>
                    <div class="clear"></div>
                    <div class="caroufredsel_wrapper" style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; width: 520px; height: 70px; margin: 0px; overflow: hidden;">
                        <ul class="listMphoto" id="foo3">
                            <?php $i=1; foreach($photos as $photo){?>
                            <li><a href="<?php echo base_url().get_config_value('upload_gallery_path').$photo->image; ?>" data-fancybox-group="button" class="fancybox-buttons"><img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_gallery_path').$photo->image.'&q=100&w=60&h=60'; ?>" alt=""/></a></li>
                            <?php $i++; }?>
                            <?php if($i<8){ for($i; $i<9; $i++){?>
                            <li></li>
                            <?php }}?>
                        </ul>
                    </div>
                    <div class="clear"></div>
                    <a href="javascript:void(0);" class="bntNext" id="foo3_next" style="display: block;">Næste <span class="red"> &gt; </span></a> <a href="javascript:void(0);" class="bntPev" id="foo3_prev" style="display: block;"><span class="red"> &lt; </span> Tilbage</a>
                </div>
                <!--myPhoto-->
                <div class="bloger m-b20 clearfix" style="padding-bottom:10px;">
                    <h2>Jeg sukkerblogger</h2>
                    <div class="clear"></div>
                    <?php if($blogs){ foreach($blogs as $blog){
                        $detail_link = base_url().index_page().'user/blogdetail/'.$blog->id.'/'.$blog->alias.'.html';
                    ?>
                    <div class="topNews bor-b">
                        <h4 style="color:#ffffff;"><?php echo date('H:i d/m/Y', $blog->time);?></h4>
                        <a href="<?php echo $detail_link;?>" style="font-size:14px; margin-bottom:5px; font-weight:bold; margin-left:20px; display:block;"><?php echo $blog->title;?></a>
                        <div class="clear"></div>
                        <div class="ml20">
                            <?php if($blog->image){?>
                                <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_blog_path').$blog->image.'&q=100&w=209'; ?>" alt=""/>
                            <?php }?><br />
                            <?php echo implode(' ', array_slice(explode(' ', strip_tags($blog->content)), 0, 50)).'...';?>
                        </div>
                    </div>
                    <?php }}?>
                    
                    <a href="<?php echo base_url().index_page();?>user/blog.html" class="bntNext" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Mere <span class="red">&gt;</span></a>
                    <div class="clear"></div>
                    <a name="se-hvad-der-sker">&nbsp;</a>
                    <?php if(member_type()==2){?>
                    <div class="blogerComment clearfix">
                        <h2>Se hvad der sker</h2>
                        <div class="clear"></div>
                        <?php if($activities){?>
                        <?php foreach($activities as $activity){
                            $profile_link = base_url().index_page().'profiles/detail/'.$activity->id.'/'.$activity->name.'.html';
                        ?>
                        <div class="commentItem">
                            <div class="f-l w420">
                                <a href="<?php echo $profile_link;?>">
                                    <?php if($activity->avatar){?>
                                    <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$activity->avatar.'&q=100&w=29&h=29'; ?>" alt=""/>
                                    <?php } else{?>
                                    <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').'noavatar'.$activity->gender.'.jpg'.'&q=100&w=29&h=29'; ?>" alt=""/>
                                    <?php }?>
                                </a>
                                <p style="margin-left: 32px;">
                                    <span class="userName"><a href="<?php echo $profile_link;?>"><?php echo $activity->name;?></a></span>
                                    <?php 
                                    if($activity->type == 1){
                                        echo 'har postet: <strong>'.$activity->data.'</strong>';
                                    } else if($activity->type == 2){
                                        echo 'har tilføjet: <strong>'.$activity->data.'</strong> billeder';
                                    } else if($activity->type == 3){
                                        echo 'har købt: <strong>'.$activity->data.'</strong>';
                                    } else {
                                        //Nothing
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="f-r w100 text-r">
                                <p><?php echo get_time_difference_php($activity->time);?></p>
                            </div>
                        </div>
                        <?php }}?>
                    </div>
                    <div class="bntSeemore m-t10"><a href="javascript:void(0);"><img alt="Se mere" style="vertical-align: inherit;" src="<?php echo base_url(); ?>/assets/frontend/img/seemore.png" /></a></div>
                    <input type="hidden" id="offset" value="3" />
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?>
</div>
<script>
jQuery(document).ready(function(){
	jQuery("#minprofil_active").addClass('active');
	});
</script>