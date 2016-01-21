<script language="javascript">
jQuery(document).ready(function(){
	jQuery("#forgetPasswordForm").validate({
		rules: {
			email: {
				required: true,
                email: true
			}
		}
	});
});// JavaScript Document
</script>
<div class="clearfix bgContent" id="sugarDates">
    <div class="contentLeft">
        <ul class="breakcum">
            <li><a href="<?php echo base_url(); ?>">Start</a></li>
            <li><a href="">Glemt adgangskode</a></li>
        </ul>
        <h2>Glemt adgangskode</h2>
        <div class="clearfix"></div>
        <div class="contact">
            <div class="contact-info">
                <p>Skift adgangskode korrekt, skal du logge ind ved ny adgangskode.</p>
            </div>
        </div>
        <!--.contact--> 
    </div>
    <!--contentLeft-->
    
    <?php echo modules::run('banner/banner/index'); ?>
    <!--adsRight-->
    <div class="clear"></div>
</div>
