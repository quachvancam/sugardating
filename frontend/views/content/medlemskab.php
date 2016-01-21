<div id="sugarDates" class="clearfix bgContent m-t-3">
<div class="contentLeft">
<ul class="breakcum">
<li><a href="<?php echo base_url(); ?>">Start</a></li>
<li><a href="<?php echo base_url().index_page(); ?>medlemskab.html">Medlemskab</a></li>
</ul>
<div class="conditions">
    <h2><?php echo $title;?></h2>
    <div class="clear"></div>
    <?php echo $info;?>
    <a href="<?php echo base_url().index_page();?>index.html"><img src="<?php echo base_url();?>assets/frontend/img/btnGohome.png" /></a>
</div><!--conditions-->
</div><!--contentLeft-->
<?php echo modules::run('banner/banner/index'); ?>
<!--adsRight-->
<div class="clear"></div>
</div>