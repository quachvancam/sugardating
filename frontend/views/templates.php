<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]>
<!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Le Duc Cuong" />
<link rel="shortcut icon" type="img/x-icon" href="<?php echo base_url(); ?>assets/frontend/icon/icon.ico" />
<link rel="shortcut icon" type="img/x-icon" href="<?php echo base_url(); ?>assets/frontend/icon/icon.png" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/reset.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/styles.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/reveal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/font/stylesheet.css"/>

<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300|Marck+Script' rel='stylesheet' type='text/css'/>
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Source+Sans+Pro:300:latin', 'Marck+Script::latin' ]}
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })();
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.carouFredSel-6.0.1-packed.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.reveal.js"></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/frontend/js/jquery.validate.pack.js'></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/tytabs.jquery.min.js"></script>

<script type="text/javascript">
<!--
jQuery(document).ready(function(){
	jQuery("#tabsholder").tytabs({
		tabinit:"1",
		fadespeed:"fast"
	});
});
-->
</script>
<!-- aToolTip css -->
<link type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/atooltip.css" rel="stylesheet"  media="screen" />

<!-- aToolTip js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/atooltip.min.jquery.js"></script>
<script type="text/javascript">
  $(function(){
    $('a.normalTip').aToolTip();
  });
</script>
<script type="text/javascript">
function AddToCart(id){
    var id_ = id;
    var name_ = $("#name_"+id).val();
    var qty_ = $("#qty_"+id).val();
    var price_ = $("#price_"+id).val();
    var pro = {id: id_, name: name_, qty: qty_, price: price_};
    $.ajax({
    	type: 'post',
    	url: '<?php echo base_url().index_page();?>cart/insert.html',
        data: {dataInput: pro,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
    	success:function (result){
            $('#contentMiniCart').html(result);
            
    	}			
    });
}
function AddToCartGift(id){
    var id_ = id;
    var name_ = $("#name_"+id).val();
    var qty_ = $("#qty_"+id).val();
    var price_ = $("#price_"+id).val();
    var namegift_ = $("#namegift").val();
    var emailgift_ = $("#emailgift").val();
    if($("#sendtomail").is(':checked')){
        var sendtomail_ = $("#sendtomail").val();
    }
    else{
        var sendtomail_ = 0;
    }
    var fromgift_ = $("#fromgift").val();
    var textgift_ = $("#textgift").val();
    var pro = {id: id_, name: name_, qty: qty_, price: price_, namegift: namegift_, emailgift: emailgift_, sendtomail: sendtomail_, fromgift: fromgift_, textgift: textgift_};
    $.ajax({
    	type: 'post',
    	url: '<?php echo base_url().index_page();?>cart/insertgift.html',
        data: {dataInput: pro,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
    	success:function (result){
            //$('#contentMiniCart').html(result);
            $("#close-f-cart").click();
            $("#sendGift")[0].reset();
            $("#showMiniCart").click();
    	}			
    });
}
function ShowMiniCart(id){
    $.ajax({
    	type: 'post',
    	url: '<?php echo base_url().index_page();?>cart/minicart.html',
        data: {dataInput: id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
    	success:function (result){
            $('#contentMiniCart').html(result);
    	}			
    });
}
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/shop.js"></script>
<title><?php echo $title;?></title>
<style>
.bg_alert {
    width: 390px;height: 115px;margin: 0px auto;padding: 15px 0px 0px 83px;color: #000;
    background:url(<?php echo base_url();?>assets/frontend/img/bg_alert.png) no-repeat top left;
}
</style>
</head>
<body>
<!--Popup-->
<div class="bg_alert" id="show_popup" style="display:none; position: fixed; top: 35%; left: 48%; z-index:10001; margin-left:-170px;"> <span id="f_focus" style="display:none;"></span>
    <div style="margin:0; padding-top:10px; min-height:60px; font-size:14px;" id="alert"></div>
    <div style="padding-left: 90px;"><a href="javascript:void(0);" onclick="close_popup();"><img src="<?php echo base_url(); ?>assets/frontend/img/bt_luk1.png" alt="" /></a></div>
</div>
<!--End Popup--> 
<!--Need-->
<div style="display: none;position: fixed; top: 0;left: 0;width: 100%;height: 100%;background-color: #000000;z-index:10000;-moz-opacity: 0.8;opacity:.80;filter: alpha(opacity=80);" id="backoverlay"></div>
<!--End--> 
<!--#f-givagave-->
<div id="f-errorPage" class="reveal-modal">
    <div class="p-content clear-fix">
        <p class="iconErorr">Log ind som Sugardating.dk medlem og du kan lege videre...</p>
        <a class="bntLogin f-l m-l65" href="<?php echo base_url().index_page(); ?>user/login.html">Login</a> <a class="bntSignup" href="<?php echo base_url().index_page(); ?>user/register.html"></a> <a id="close-f-errorPage" class="close-reveal-modal"></a> </div>
</div>
<!--.f-errorPage-->
<div id="f-upgradePage" class="reveal-modal">
    <div class="p-content clear-fix">
        <p class="iconErorr">Opgradér venligst dit medlemskab, hvis du også vil lege med hér</p>
        <a class="btn-upgrade f-l" href="<?php echo base_url().index_page(); ?>user/upgrade.html">Login</a> <a id="close-f-upgradePage" class="close-reveal-modal"></a> </div>
</div>
<!--Mini Cart-->
<div id="f-cart" class="reveal-modal">
    <div class="p-content2 clear-fix" >
        <div id="contentMiniCart"> 
            <!-- Show mini cart here--> 
        </div>
        <a class="bntgoCart" href="<?php echo base_url().index_page(); ?>cart/index.html">GÅ TIL INDKØBSKURVEN</a><a id="close-f-cart" class="close-reveal-modal"></a> </div>
</div>
<!--End Mini Cart--> 
<!--Send gif-->
<div id="f-givagave" class="reveal-modal">
    <div class="p-content2 clear-fix"> <?php echo form_open('cart/insertGift', array('id'=>'sendGift'))?>
        <fieldset>
            <div class="givagave">
                <h2 style="font-size: 24px;">HVEM VIL DU GØRE GLAD MED EN GAVE FRA DIG?</h2>
                <p>Modtageren modtager en email om hvordan han/hun modtager sin gave, efter at din konto er blevet opkrævet.</p>
                <div>
                    <label>Modtagers navn:</label>
                    <input onblur="validateGift()" type="text" name="namegift" id="namegift" value=""/>
                </div>
                <div class="f-r m-t-63">
                    <label>Modtagers email:</label>
                    <input class="m-b10" onblur="validateGift()" type="text" name="emailgift" id="emailgift" value="" />
                    <br/>
                    <input class="cb4" name="sendtomail" id="sendtomail" value="1" type="checkbox" checked="true"/>
                    Send en kopi til min e-mail </div>
                <div>
                    <label>Fra:</label>
                    <input onblur="validateGift()" type="text" name="fromgift" id="fromgift" value=""/>
                </div>
                <div>
                    <label>Besked til modtager</label>
                    <textarea  onblur="validateGift()" name="textgift" id="textgift"></textarea>
                </div>
            </div>
            <!--.givagave-->
            <input type="hidden" name="gift-id" id="gift-id" value="" />
            <a class="bntSendgave f-r" onclick="sendGift()" href="javascript:void(0);">SEND GAVE</a><a id="close-reveal-modal2" class="close-reveal-modal"></a>
        </fieldset>
        </form>
    </div>
</div>
<!--End send gif-->
<div id="page">
    <div class="lineTop"></div>
    <div id="w-page">
        <div id="w-header"> 
            <div id="login" class="clearfix"> <?php echo modules::run('login/login/header_site'); ?>
                <div class="numCart"> <span class="inumCart"> <a id="showMiniCart" onclick="ShowMiniCart(0)" href="javascript:void(0);" data-reveal-id="f-cart">(<?php echo $this->cart->total_items();?>) <img style="vertical-align: middle;" src="<?php echo base_url(); ?>assets/frontend/img/iconCart.png"/></a> </span></div>
            </div>
            <div class="clearfix"></div>
            <?php require 'common/header.php'; ?>
        </div>
        <?php if($content == "home"){?>
        <div id="banner" class="clearfix">
            <div id="f-login"><?php echo modules::run('login/login/index'); ?></div>
            <div id="mainBanner">
                <?php if(checkLogin()){?>
                <div class="html_carousel">
                    <?php echo modules::run('mslideshow/mslideshow/index'); ?> 
                </div>
                <?php } else {?>
                <a class="bntComehere" href="<?php echo base_url().index_page(); ?>user/register.html">Kom herind og leg med</a>
                <script type="text/javascript">
                    jQuery( document ).ready(function() {
                        jQuery("video").css('opacity', 0).animate( { opacity: 1}, 'slow');
                        jQuery("video").css('z-index', 1);
                    });
                </script>
                <video autoplay="" preload="auto" controls="" width="760px" height="360" loop="" src="<?php echo base_url(); ?>assets/frontend/videos/intro.mp4">
                    <source src="<?php echo base_url(); ?>assets/frontend/videos/intro.webm" type="video/webm; codecs=vp8,vorbis"/>
                    <source src="<?php echo base_url(); ?>assets/frontend/videos/intro.mp4" type="video/mp4"/>
                    <source src="<?php echo base_url(); ?>assets/frontend/videos/intro.ogv" type='video/ogg' />
                </video>
                <?php }?>   
            </div>
        </div>
        <?php } else{?>
        <div id="banner" style="height: 60px;"></div>
        <?php }?>
        <div id="main">
            <div class="indexPage">
                <?php require_once ("content/".$content.".php");?>
                <div class="w-connect clearfix m-t20"> <?php echo modules::run('article/article/index'); ?> 
                    <?php echo modules::run('article/article/del'); ?> 
                    <?php echo modules::run('article/article/faq'); ?> 
                </div>
            </div>
        </div>
        <!--#main--> 
    </div>
    <!--#w-page-->
    <div class="clear"></div>
    <!--Footer-->
    <?php require 'common/footer.php'; ?>
    <!--#footer--> 
</div>
<!--Cookie content-->
<?php echo modules::run('cookie/index'); ?>
<!--End Cookie-->
<?php
$display = "";
if(member_type() == 1){
    $display = 'style="display: none;"';
}
?>
<div <?php echo $display;?> id="cometchat"></div>
<link type="text/css" href="<?php echo base_url(); ?>cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8"/>
<script type="text/javascript" src="<?php echo base_url(); ?>cometchat/cometchatjs.php" charset="utf-8"></script>
</body>
</html>