<div id="sugarDates" class="clearfix bgContent m-t-3">
    <div class="contentLeft">
    <ul class="breakcum">
    <li><a href="<?php echo base_url(); ?>">Start</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>sugarshop/checkout.html">Opret trin 1</a></li>
    </ul>
    <div class="f-checkout clear">
        <a class="bntStep1" href="javascript:void(0);">Trin 1</a>
        <a class="bntStep2a" href="javascript:void(0);">Trin 2</a>
        <div class="clear"></div>
            <div class="f-l w363 m-t10">
                <?php if($user && !$b2b){?>
                 <div>
                    <label><i>Profil navn</i> : <?php echo $user->name;?></label>
                </div>
				<div>
                    <label><i>Post nr. </i> : <?php echo $user->code;?></label>
                </div>
				<div>
                    <label><i>By </i> : <?php echo $user->city;?></label>
                </div>
				<div>
                    <label><i>Telefon </i> : <?php echo $user->phone;?></label>
                </div>
				<div>
                    <label><i>E-mail</i> : <?php echo $user->email;?></label>
                </div>
                <?php }else{?>
                <p class="yellow">Er du Sugar medlem?</p>
                <p>Husk dine Sugar rabatfordele. Login og gå direkte til betaling <a class="btn-here" href="<?php echo base_url().index_page(); ?>user/login.html">hér</a></p>
                <div class="m-t20">
                  <p class="yellow">Er du ikke Sugar medlem?</p>
                  <p>Gå ikke glip af Sugar rabatfordelene. Opret gratis Sugar medlemskab og gå til betaling med Sugar rabat <a class="btn-here" href="<?php echo base_url().index_page(); ?>user/register.html">hér</a></p>
                  
                </div>
                <?php }?>    
            </div>
            <div class="f-r m-t10 w383">
            	<div class="myCart">
                    <div class="titleGray2 clearfix">
                    <h3>Min indkøbs kurv</h3>
                    <div class="w168 f-l">valgt</div>
                    <div class="w65 f-l">stk</div>
                    <div class="w65 f-l">sugar</div>
                    <div class="w65 f-l">pris</div>
                    </div>
                    <?php if($cart){ foreach($cart as $rows){?>
                    <div class="clearfix bor-b2 p10">
                    <div class="w168 f-l">
                      <a href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $rows['id']."/".seo_url($rows['name']);?>.html">
                        <img class="m-l10" src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $rows['image']; ?>&h=39&w=39&q=100" alt=""/>
                      </a>
                      <p><?php echo $rows['name'];?></p>
                    </div>
                    <div class="w65 f-l"><?php echo $rows['qty'];?></div>
                    <div class="w65 f-l"><?php echo priceFormat($rows['price']);?></div>
                    <div class="w65 f-l"><?php echo priceFormat($rows['qty']*$rows['price']);?></div>
                    </div>
                    <?php }}?>
                    <div class="clearfix text-r mt20">
                    <div class="f-l m-l85">
                      <h4>Subtotal inkl. moms: </h4>
                    </div>
                    <div class="f-r p-r20">
                      <h4><?php echo priceFormat($tatal);?></h4>
                    </div>
                    </div>
                    <div class="clearfix text-r">
                    <div class="f-l m-l85">
                      <h4>Heraf moms: </h4>
                    </div>
                    <div class="f-r p-r20">
                      <h4><?php echo priceFormat($tatal*0.2);?></h4>
                    </div>
                    </div>
                    <div class="clearfix text-r mb20">
                    <div class="f-l m-l85">
                      <h4>Total inkl. moms:</h4>
                    </div>
                    <div class="f-r p-r20">
                      <h4><?php echo priceFormat($tatal);?></h4>
                    </div>
                    <div class="f-r">
                        <input class="cb3" type="checkbox" name="checkbox" id="checkbox" /> 
                        <p class="f-l m-t5" style="font-size: 13px !important; color: #fff;">Jeg har læst og accepterer Sugardating.dk<br />
                            <a class="red" target="_blank" href="<?php echo base_url().index_page(); ?>medlemsbetingelser/shop.html">vilkår og handelsbetingelser</a>
                        </p>
                      </div>
                    </div>
                    
                </div><!--myCart-->
            </div><!---->
            <div class="clear"></div>
           <div class="bor-b2"></div>
           <a class="bntconShop1 f-l" href="<?php echo base_url().index_page(); ?>sugarshop/index.html">Fortsæt shopping</a>
           <?php if($user){?>
           <a class="bntconfirmOrder1 f-r" onclick="checked();" href="javascript:void(0);">Bekræft order</a>
           <?php }else{?>
           <a class="bntconfirmOrder1 f-r" onclick="noLogin();" href="javascript:void(0);">Bekræft order</a>
           <?php }?>
           <a style="display: none;" id="send" class="bntconfirmOrder1 f-r" href="<?php echo base_url().index_page(); ?>sugarshop/payment.html">Bekræft order</a>
        
    </div><!--.f-step1-->
    </div><!--contentLeft-->
  <?php echo modules::run('banner/banner/index'); ?>
  <!--adsRight-->
  <div class="clear"></div>
</div>
<script type="text/javascript">
function send_checkout(){
    document.getElementById('send').click();
    //$('#send').click();
}
function checked(){
    var checkbox = document.getElementById ('checkbox');
    if(checkbox.checked==false){
        $('#alert').html('Venligst check "Jeg har læst og accepterer Sugardating’s"');
        $('#backoverlay').show();
        $('#show_popup').show();
    	return false;
    } else {
    	send_checkout();				
    }
}
function noLogin(){
    $('#alert').html('Venligst login og gå direkte til betaling');
    $('#backoverlay').show();
    $('#show_popup').show();
	return false;
}
</script>
<!--#sugarDates -->