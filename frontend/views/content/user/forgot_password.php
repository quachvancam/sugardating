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
            <li><a href="<?php echo base_url().index_page();?>user/forgotpassword.html">Glemt adgangskode</a></li>
        </ul>
        <h2>Har du glemt din adgangskode?</h2>
        <div class="clearfix"></div>
        <div class="contact">
            <div class="contact-info">
                <p>Indtast din e-mail i den hvide boks herunder og tryk på send.</p>
                <p>Herefter modtager du en e-mail med din nye adgangskode.</p>
                <p>Oplever du stadig problemer med dit login, tjek da vores FAQ eller kontakt evt. vores <a href="mailto:kundeservice@sugardating.dk">kundeservice@sugardating.dk</a></p>
                    
                
                
                
                <div class="frm-contact">
                    <?php echo form_open('user/forgotten_password_process', array('id'=>'forgetPasswordForm'))?>
                        <fieldset>
                            <label for="">Indtast din e-mail</label>
                            <input type="text" class="txt-contact" name="email" id="email">
                            <div class="clearfix"></div>
                            <input type="submit" class="btn-send" style="border:none; cursor:pointer;" />
                            <span style="color:#F00; font-size:15px;"><?php echo $this->session->flashdata('message') ? $this->session->flashdata('message') : '';?></span>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <!--.contact--> 
    </div>
    <!--contentLeft-->
    
    <?php echo modules::run('banner/banner/index'); ?>
    <!--adsRight-->
    <div class="clear"></div>
</div>
