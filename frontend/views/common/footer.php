<!--Check utf-8 Cường-->
<div id="footer">
    <div id="w-footer">
        <ul class="clearfix">
            <li><a href="<?php echo base_url().index_page(); ?>index.html">Start</a></li>
            <li><a href="<?php echo base_url().index_page();?>user/owner.html" <?php if(!member_type()){?>data-reveal-id="f-errorPage"<?php }?>>Min Profil</a></li>
            <li><a href="<?php echo base_url().index_page(); ?>sugarshop/index.html">Sugarshop</a></li>
            <?php if($this->_ci_cached_vars['content'] != 'faq'){?><li><a href="<?php echo base_url().index_page(); ?>faq.html"><span>FAQ</span></a></li><?php }?>
            <?php if($this->_ci_cached_vars['content'] != 'help'){?><li><a href="<?php echo base_url().index_page(); ?>help.html">Hjælp</a></li><?php }?>
            <?php if($this->_ci_cached_vars['content'] != 'sikkerhed'){?><li><a href="<?php echo base_url().index_page(); ?>sikkerhed.html"><span>Sikkerhed</span></a></li><?php }?>
            <?php if($this->_ci_cached_vars['content'] != 'medlemsbetingelser'){?><li><a href="<?php echo base_url().index_page(); ?>medlemsbetingelser.html">Vilkår og handelsbetingelser</a></li><?php }?>
            <?php if($this->_ci_cached_vars['content'] != 'medlemskab'){?><li><a href="<?php echo base_url().index_page(); ?>medlemskab.html">Medlemskab</a></li><?php }?>     
            <?php if($this->_ci_cached_vars['content'] != 'kontakt'){?><li class="end"><a href="<?php echo base_url().index_page(); ?>kontakt.html">Kontakt</a></li><?php }?>
        </ul>
        <div class="clear"></div>
        <span>Copyright © 2014. All Rights Reserved.</span>
    </div>
</div>