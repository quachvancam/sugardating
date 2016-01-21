<!--Check utf-8 Cường-->
<div id="wraNav" class="clearfix">
  <div id="logo"><a href="<?php echo base_url().index_page();?>index.html">Sugardating</a></div>
  <ul id="mainNav">
    <li id="srart_active"><a href="<?php echo base_url().index_page();?>index.html">Start</a></li>
    <li id="minprofil_active"><a href="<?php echo base_url().index_page();?>user/owner.html" <?php if(!member_type()){?>data-reveal-id="f-errorPage"<?php }?>>Min Profil</a></li>
    <li id="sugarshop_active"><a href="<?php echo base_url().index_page();?>sugarshop/index.html">Sugarshop</a></li>
    <li id="faq_active"><a href="<?php echo base_url().index_page();?>faq.html">FAQ</a></li>
    <li id="help_active"><a href="<?php echo base_url().index_page();?>help.html">Hjælp</a></li>
  </ul>
</div>