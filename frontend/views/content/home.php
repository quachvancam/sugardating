<?php if(!isLogged()){?>
<div class="topMain"><a class="bntWelcome" href="<?php echo base_url().index_page(); ?>user/register.html">Bliv <span class="upper">GRATIS</span> sugar medlem</a></div>
<?php }?>
<?php echo modules::run('home/home/get_data'); ?>
<div id="sugarDates" class="clearfix">
  <div class="contentLeft">
    <h2>Sugar dates</h2>
    <div class="clear"></div>
    <div id="tabsholder" class="m-t10">
      <ul class="tabs">
        <li id="tab1">Date opslag <sup style="font-size: 14px;font-family: century gothic;">&reg;</sup></li>
        <li id="tab2">SugarDads</li>
        <li id="tab3">SugarMoms</li>
        <li id="tab4">Sugar baby ( F )</li>
        <li id="tab5">Sugar baby ( M )</li>
      </ul>
      <div class="contents marginbot">
        <div id="content1" class="tabscontent clearfix">
            <?php echo modules::run('mdating/mdating/index'); ?>
        </div>

        <div id="content2" class="tabscontent bgNone">
            <?php echo modules::run('msugar/msugar/index', 3, 'content2', 'moreSugarDad'); ?> 
        </div>
        <div id="content3" class="tabscontent bgNone">
            <?php echo modules::run('msugar/msugar/index', 4, 'content3', 'moreSugarMom'); ?> 
        </div>
        <div id="content4" class="tabscontent bgNone">
            <?php echo modules::run('msugar/msugar/index', 2, 'content4', 'moreSugarBabyF'); ?> 
        </div>
        <div id="content5" class="tabscontent bgNone">
            <?php echo modules::run('msugar/msugar/index', 1, 'content5', 'moreSugarBabyM'); ?>
        </div>
      </div>
    </div>
  </div>
  <?php echo modules::run('banner/banner/index'); ?>
  <div class="clear"></div>
</div>
<?php echo modules::run('shop/shop/index'); ?>
<script>
jQuery(document).ready(function(){
	jQuery("#srart_active").addClass('active');
	});
</script>