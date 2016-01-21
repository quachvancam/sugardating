<?php 
$own = array(0=>"", 1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
$chat_link = "javascript:jqcc.cometchat.chatWith('".$user->id."');";
$img = '';
if($user->avatar){
   $avatar = $user->avatar;
} else {
   $avatar = 'noavatar'.$user->gender.'.jpg';
}
$img = '<img src="'.base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$avatar.'&q=100&w=60" alt=""/>';
?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/fancybox/jquery.fancybox.js?v=2.1.3"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />
<script type="text/javascript">
jQuery(document).ready(function(){
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
});
function checkstatus(data){
    //console.log(data); // To see output using Firebug
    if (data.s == 'available') {
        $("#online").append('<div class="online"><img src="<?php echo base_url(); ?>assets/frontend/img/iconDoc-Green.png" /> Online</div>');
    } else {
        $("#online").append('<div class="offline"><img src="<?php echo base_url(); ?>assets/frontend/img/iconDoc-Red.png" /> Offline</div>');
    }
}
function checkstatus1(data){
    //console.log(data); // To see output using Firebug
    if (data.s == 'available') {
        $("#online1").append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconDoc-Green.png" />');
    } else {
        $("#online1").append('<img src="<?php echo base_url(); ?>assets/frontend/img/iconDoc-Red.png" />');
    }
}
window.onload = function() {
    jqcc.cometchat.getUser('<?php echo $user->id;?>','checkstatus');
    jqcc.cometchat.getUser('<?php echo $user->id;?>','checkstatus1');
}
</script>
<div class="clearfix bgContent" id="sugarDates">
    <div class="contentLeft">
        <?php echo modules::run('profile/left_content',$user->id); ?>
        <div class="info-profil">
            <span id="online"></span>
            <div class="profil-cnt">
                <div class="info-profile" style="width: 298px;">
                    <h2 style="float:left;"><?php echo $user->name;?></h2>
                    <div class="iconFind-Male f-l"> 
                        <a style="height: 28px; display:block;" class="normalTip" title="<?php echo $own[$user->own];?>">
                            <img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/icon<?php echo $user->own;?>.png"/>
                        </a> 
                        <a style="height: 18px; display:block;" title="<?php echo $own[$user->play];?>" class="normalTip"> 
                            <img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/icon<?php echo $user->play;?>-1.png"/>
                        </a> 
                    </div>
                    <div class="clear"></div>
                    <p>Alder: <?php echo get_age($user->day, $user->month, $user->year);?> år<br/>
                       Højde: <?php echo $user->height;?> cm<br/>
                       Vægt: <?php echo $user->weight;?> kg<br/>
                       Postnr: <?php echo $user->city;?></p>
                    <img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/bntMember<?php echo $user->member;?>.png"/>
                </div>
                <div class="lightbox-profil">
                    <h6 style="padding: 8px 10px; position: relative;"><?php echo $user->name;?> <span id="online1"></span>
                        <a title="<?php echo $own[$user->own];?>" class="normalTip sex"  style="position: absolute; right: 5px; top: 0;"><img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/icon<?php echo $user->own;?>-2.png"></a>
                    </h6>
                    <div class="profil-img-s"> 
                        <?php echo $img;?>
                    </div>
                    <div class="profil-stt">
                        <p><?php echo $user->status;?></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="box-red status">
                        <?php echo get_order_category($user->id);?>
                        <?php if(member_type_user($user->id)==2){?>
                        <a href="<?php echo $chat_link;?>" class="bntChatme" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?> style="margin-left:10px;"><img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/btn-chatmig.jpg"/></a>
                        <?php }?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="sugarBox">
                    <h2>Sugar Box <sup style="font-size: 14px;font-family: century gothic;">&reg;</sup></h2>
                    <ul class="sugarTitle">
                        <li style="margin-right:15px;"><a class="l1" href="<?php echo base_url().index_page();?>sugarshop/mypurchase/<?php echo $user->id;?>.html">Købte</a></li>
                        <li style="margin-right:180px;"><img src="<?php echo base_url(); ?>/assets/frontend/img/iconHeart-Gray_red.png" />Ønskeliste</li>
                    </ul>
                    <div class="clear"></div>
                    <?php echo modules::run('mbox/mbox/index', $user->id); ?>
                </div>
                
                <div class="myPhoto bor-b clearfix">
                    <h2><?php echo $user->name;?>'s billeder</h2>
                    <div class="clear"></div>
                    <div class="caroufredsel_wrapper" style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; width: 260px; height: 70px; margin: 0px; overflow: hidden;">
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
                    <a href="javascript:void(0);" class="bntNext" id="foo3_next" style="display: block;">Næste <span class="red"> &gt; </span></a> <a href="javascript:void(0);" class="bntPev" id="foo3_prev" style="display: block;"><span class="red"> &lt; </span> Tilbage</a> </div>
                <!--myPhoto-->
                <div class="bloger m-b20 clearfix">
                    <h2>Jeg sukkerblogger</h2>
                    <div class="clear"></div>
                    <?php foreach($blogs as $blog){
                        $detail_link = base_url().index_page().'blog/detail/'.$blog->id.'/'.$blog->alias.'.html';
                    ?>
                    <div class="topNews bor-b">
                        <h4 style="color:#ffffff;"><?php echo date('H:i d/m/Y', $blog->time);?></h4>
                        <a href="<?php echo $detail_link;?>" style="font-size:14px; margin-bottom:5px; font-weight:bold; display:block;"><?php echo $blog->title;?></a>
                        <div class="clear"></div>
                        <?php if($blog->image){?>
                        <a href="<?php echo $detail_link;?>"><img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_blog_path').$blog->image.'&q=100&w=209'; ?>" ></a>
                        <?php }?>
                        <p><?php echo implode(' ', array_slice(explode(' ', strip_tags($blog->content)), 0, 50)).'...';?></p>
                    </div>
                    <?php }?>
                    <!--topNews-->
                    <a class="bntNext" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?> href="<?php echo base_url().index_page().'blog/bloglist/'.$user->id.'/'.$user->name.'.html'?>">Næste <span class="red">&gt;</span></a> </div>

                </div>
            </div>
        </div>
    <?php echo modules::run('banner/banner/index'); ?> 
    <div class="clear"></div>
</div>