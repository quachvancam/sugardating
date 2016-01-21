<script language="javascript">
jQuery(document).ready(function(){
	jQuery("#changePasswordForm").validate({
		rules: {
			password: {
				required: true,
                minlength: 6
			},
			confirm_password: {
				equalTo: "#password"
			}
		},
        messages: {
            password: {
                required: "Indtast en adgangskode",
                minlength: jQuery.format("Indtast mindst {0} tegn")
            },
            confirm_password: "Indtast den samme værdi igen"
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
                <p>Udfyld nedenstående felt</p>
            </div>
            <div class="frm-contact">
                <?php echo form_open('user/change_password_process', array('id'=>'changePasswordForm'))?>
                <!--<form action="<?php echo base_url(); ?>user/change_password_process.html" id="changePasswordForm" method="post">-->
                    <fieldset>
                        <label for="">Indtast ny adgangskode</label>
                        <input type="password" class="txt-contact" name="password" id="password">
                        <label for="">Bekræft ny adgangskode</label>
                        <input type="password" class="txt-contact" name="confirm_password" id="confirm_password">
                        <div class="clearfix"></div>
                        <input type="submit" class="btn-send" style="border:none; cursor:pointer;" />
                    </fieldset>
                </form>
            </div>
        </div>
        <!--.contact--> 
    </div>
    <!--contentLeft-->
    
    <?php echo modules::run('banner/banner/index'); ?>
    <!--adsRight-->
    <div class="clear"></div>
</div>
