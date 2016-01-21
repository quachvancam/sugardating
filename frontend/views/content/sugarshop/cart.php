<div id="sugarDates" class="clearfix bgContent m-t-3">
  <div class="contentLeft">
   <ul class="breakcum">
   	<li><a href="<?php echo base_url(); ?>">Start</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>sugarshop/index.html">Sugar shop</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>cart/index.html">Indkøbskurv</a></li>
   </ul>
  <div class="shoppingCart">
    <h2>Indkøbs kurv</h2>
    <div class="clear"></div>
    <div class="w-cart" style="min-height: 400px;">
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
      
        <?php if($cart){ foreach($cart as $rows){?>
        <div class="cartItem m-t10 clearfix">
        <div class="w173 f-l m-r20">
            <a href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $rows['id']."/".seo_url($rows['name']);?>.html">
            <img class="m-l10" src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $rows['image']; ?>&h=39&w=39&q=100" alt=""/>
            </a>
            <p><?php echo $rows['name'];?></p>
        </div>
        <div class="w186 f-l m-r20">
          <span><?php echo $rows['title'];?>&nbsp;</span>
        </div>
        <div class="w78 f-l">
          <span><?php echo priceFormat($rows['price_old']);?></span>
        </div>
        <div class="w88 f-l">
          <p><?php echo priceFormat($rows['price']);?></p>
        </div>
        <div class="w80 f-l">
            <span style="padding: 2px 15px;"><?php echo $rows['qty'];?></span>
        </div>
        <div class="w70 f-l">
          <span><?php echo priceFormat($rows['qty']*$rows['price']);?></span>
        </div>
        <div class="w45 f-l">
          <a href="<?php echo base_url().index_page(); ?>cart/update/<?php echo $rows['rowid'];?>/<?php echo $rows['id'];?>.html"><img src="<?php echo base_url(); ?>assets/frontend/img/iconDel.png" alt=""/></a>
        </div>
        </div>
        <?php }}else{?>
        <div class="clearfix bor-b2 p10">
            Din Indkøbsvogn er tom
        </div>
        <?php }?>

      <div class="cartItem clearfix m-b10">
        <div class="f-r w120 price3 m-l m-l85">
          <p><?php echo priceFormat($tatal);?></p>
        </div>
        <div class="f-r price3">
          <p>Pris ialt:</p>
        </div>
      </div>
      <a class="bntconShop f-l" href="<?php echo base_url().index_page(); ?>sugarshop/index.html">Fortsæt shopping</a>
      <a class="bntBook f-r" href="<?php echo base_url().index_page(); ?>sugarshop/checkout.html">Bestil</a>
      <div class="clear"></div>
     
    </div><!--w-cart-->
  </div><!--.shoppingCart-->
  </div><!--contentLeft-->
    <?php echo modules::run('banner/banner/index'); ?>
  <div class="clear"></div>
</div>