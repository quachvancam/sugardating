<div id="sugarDates" class="clearfix bgContent">
    <div class="contentLeft">
        <ul class="breakcum">
            <li><a href="<?php echo base_url(); ?>">Start</a></li>
            <li><a href="<?php echo base_url().index_page(); ?>message.html">Kvittering</a></li>
        </ul>
        <h2>Kvittering</h2>
        <div class="clearfix"></div>
        <div class="contact" style="min-height: 400px;">
            <div class="contact-info">
            <div class="frm-contact">
                <?php
                if ($this->session->flashdata('message')){?>
                    <?php echo $this->session->flashdata('message');?>
                    <br /><br />
                    Med venlig hilsen<br />
                    Christina<br />
                    Sugardating.dk<br /><br />
                    <a href="<?php echo base_url().index_page(); ?>index.html"><img src="<?php echo base_url(); ?>assets/frontend/img/btn-back.jpg" title="Back" /></a>
                <?php }else{?>
                    <br /><br />
                    Med venlig hilsen<br />
                    Christina<br />
                    Sugardating.dk<br /><br />
                    <a href="<?php echo base_url().index_page(); ?>index.html"><img src="<?php echo base_url(); ?>assets/frontend/img/btn-back.jpg" title="Back" /></a>
                <?php } ?>
            </div>
            </div>
        </div>
    </div>
    <!--contentLeft-->
    <?php echo modules::run('banner/banner/index'); ?>
    <!--adsRight-->
  <div class="clear"></div>
</div>