<div id="sugarDates" class="clearfix bgContent m-t-3">
    <div class="contentLeft">
        <ul class="breakcum">
        <li><a href="<?php echo base_url(); ?>">Start</a></li>
        <li><a href="<?php echo base_url().index_page(); ?>medlemsbetingelser.html">Handels – og medlemsbetingelser for Sugardating</a></li>
        </ul>
        <div class="conditions">
            <?php echo $info;?>
            <div style="padding: 10px 0;">
                <?php if($redirect){?>
                <a class="bntClosewindows" href="javascript:void(0);" onclick="window.close();">Luk vindue</a>
                <?php }else{?>
                <a href="<?php echo base_url().index_page();?>index.html"><img src="<?php echo base_url();?>assets/frontend/img/btnGohome.png" /></a>
                <?php }?>
            </div>
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?>
    <div class="clear"></div>
</div>