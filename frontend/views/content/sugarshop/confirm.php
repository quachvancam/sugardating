<div id="sugarDates" class="clearfix bgContent m-t-3">
  <div class="contentLeft">
   <ul class="breakcum">
   	<li><a href="<?php echo base_url(); ?>">Start</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>sugarshop/index.html">sugar shop</a></li>
   </ul>
  <div class="shoppingCart">
    <h2>Tak for din ordre</h2>
    <div class="clear"></div>
    <div class="thanks m-b20">
      <p class="thanks-title">Ordrenummer: <b><?php echo $orderID;?></b></p>
      <p>En ordrebekræftelse vil blive sendt til <?php echo $user->email;?><br/>
      Har du spørgsmål, kan du kontakte os på +45 99 42 19 60<br/>
      Mandag - Torsdag kl 09.00 - 17.00, Fredag kl 09.00 - 14.30</p>
    </div><!--.thanks-->
    <div class="w-cart">
      <form name="" action="" method="">
      <fieldset>
      <div class="title-cart">
        <div class="w173 f-l m-r12">
          Valgt
        </div>
        <div class="w186 f-l m-r20">
          Beskrivelse
        </div>
        <div class="w78 f-l">
          Stk pris
        </div>
        <div class="w88 f-l">
          <div class="iconPercent">
            <img src="<?php echo base_url(); ?>assets/frontend/img/iconPercent.png" alt=""/>
          </div>
          &nbsp;
        </div>
        <div class="w80 f-l">
          Antal
        </div>
        <div class="w70 f-l">
          Pris
        </div>
      </div>
      
      <?php if($orderItems){ foreach($orderItems as $rows){?>
      <div class="cartItem m-t10 clearfix">
        <div class="w173 f-l m-r20">
          <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $rows->image; ?>&h=39&w=39&q=100" alt=""/></a>
          <p><?php echo $rows->name;?></p>
        </div>
        <div class="w186 f-l m-r20">
          <span><?php echo $rows->title;?></span>
        </div>
        <div class="w78 f-l">
          <span><?php echo priceFormat($rows->old_price);?></span>
        </div>
        <div class="w88 f-l">
          <p><?php echo priceFormat($rows->new_price);?></p>
        </div>
        <div class="w80 f-l">
          <p style="margin-left: 10px;"><?php echo $rows->quantity;?></p>
        </div>
        <div class="w70 f-l">
          <span><?php echo priceFormat($rows->quantity*$rows->new_price);?></span>
        </div>
      </div>
      <?php }}else{ ?>
      <div class="cartItem m-t10 clearfix">
        Din Indkøbsvogn er tom
      </div>
      <?php }?>
      
      <div class="cartItem clearfix m-b10">
        <div class="f-r w120 price3 m-l m-l85">
          <p><?php if($order){echo priceFormat($order->total);}else{ echo "0,-";}?></p>
        </div>
        <div class="f-r price3">
          <p>Subtotal inkl. moms:</p>
        </div><br style="clear: both;" />
        <div class="f-r w120 price3 m-l m-l85">
          <p><?php if($order){echo priceFormat($order->total*0.2);}else{ echo "0,-";}?></p>
        </div>
        <div class="f-r price3">
          <p>Heraf moms:</p>
        </div><br style="clear: both;" />
        <div class="f-r w120 price3 m-l m-l85">
          <p><?php if($order){echo priceFormat($order->total);}else{ echo "0,-";}?></p>
        </div>
        <div class="f-r price3">
          <p>Total inkl. moms:</p>
        </div>
      </div><!--.cartItem-->
      <div class="clear"></div>
      <div class="address f-l">
        <h4>Sugardating</h4>
        <p>
            <a class="color-golden" href="mailto:kundeservice@sugardating.dk">kundeservice@sugardating.dk</a> eller telefon 45 31 22 91 99<br />
            <a class="color-golden" href="http://sugardating.dk">Sugardating.dk</a>, Oehlenschlægersgade 78, 1663 København V<br />
            CVR-nr. 27 36 46 08
        </p>
        <a class="bntbackhome f-l" href="<?php echo base_url(); ?>">Tilbage til forsiden</a>
        <p class="conshopping f-l" style="margin-top: 0; display:inline-block;margin-left: 10px;"><span style="">eller</span> <a href="<?php echo base_url().index_page(); ?>sugarshop/index.html" class="bntconShop2" style="display:inline-block; margin-left: 5px; mt0">Fortsæt shopping</a></p>
      </div>
      </fieldset>
    </form>
    </div><!--w-cart-->
  </div><!--.shoppingCart-->
  </div><!--contentLeft-->

  <?php echo modules::run('banner/banner/index'); ?>
  <!--adsRight-->
  <div class="clear"></div>
</div>