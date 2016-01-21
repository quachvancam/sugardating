<div id="sugarDates" class="clearfix bgContent">
    <div class="contentLeft">
    <div class="col-profil">
      <?php echo modules::run('own/own/left_content'); ?> 
    </div>
    
    <div class="mydeal">
      <h2>Mine gaver</h2>
      <div class="clear"></div>
      
      <?php if($mydeals) { foreach($mydeals as $rows){
      ?>
      <div class="dealItem clearfix">
        <h3><?php echo $rows->name;?></h3>
        <div>
            <a style="float: left;" href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $rows->id."/".seo_url($rows->name);?>.html" class="item-deal">
                <img src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $rows->image1; ?>&h=113&w=220&q=100" alt=""/> <span><img src="<?php echo base_url(); ?>upload/deal_category/<?php echo $rows->red_icon; ?>" alt=""/></span>
            </a>
            <?php echo $rows->title;?>
        </div>
        <div style="clear: both;"></div>
        <div>Antal: <?php echo $rows->quantity;?>&nbsp;&nbsp;
        
        <a href="<?php echo base_url().index_page(); ?>sugarshop/printdeal/<?php echo $rows->itemid."/".seo_url($rows->name);?>.html" target="_blank">Udskriv tilbud</a>&nbsp;&nbsp;
        Indløst: <?php echo $rows->codes;?>&nbsp; <?php if($rows->status){ echo "Ja";}else{ echo "Nej";}?></div>
      </div>
      
      <?php }}else{?>
      <div class="dealItem clearfix">
        
      </div>
      <?php }?>

      <div class="pagging">
        
      </div>
    </div><!--.mydeal-->
    </div>
    <!--contentLeft-->
    
    <?php echo modules::run('banner/banner/index'); ?>
    <!--adsRight-->
    <div class="clear"></div>
</div>
<!--#sugarDates -->
<?php echo modules::run('shop/shop/index'); ?>