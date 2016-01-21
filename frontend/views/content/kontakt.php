<script language="javascript">
jQuery(document).ready(function(){
	jQuery("#kontaktForm").validate({
		rules: {
			name: {
				required: true
			},
            email: {
				required: true,
                email: true
			},
            besked: {
				required: true
			},
            captcha: {
				required: true
			}
		}
	});
});// JavaScript Document
</script>
<div id="sugarDates" class="clearfix bgContent">
    <div class="contentLeft">
    <ul class="breakcum">
    <li><a href="<?php echo base_url(); ?>">Start</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>kontakt.html">Kontakt</a></li>
    </ul>
    <h2>Kontakt</h2>
    
    <div class="clearfix"></div>
    <div class="contact">
    <p>Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que
    se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos.</p>
    <div class="contact-info">
    <p><b>Sugardating</b><br/>
    123 Lorem Ipsum ha sido<br/>
    el texto de relleno estándar<br/>
    1500</p>
    <p><a href="mailto:xxxx@sugardate.me">xxxx@sugardate.me</a></p>
    <p>CVR123-4567-890</p>
    <div class="frm-contact">
    <?php if($this->session->flashdata('error')){
        echo '<div style="padding:10px; color:#ff0000;">'.$this->session->flashdata('error').'</div>';
	}
	?>
    <?php echo form_open('kontaktSend', array('id'=>'kontaktForm'))?>
    <fieldset>
        <label for="">Navn</label>
        <input class="txt-contact" name="name" id="name" type="text"/>
        <label for="">Email</label>
        <input class="txt-contact" name="email" id="email" type="text"/>
        <label for="">Besked</label>
        <textarea class="txa" name="besked" id="besked"></textarea>
        <div class="clearfix"></div>
        <div class="capcha">
            <img style="padding-left:10px;vertical-align: middle;" src="<?php echo base_url(); ?>assets/captcha/create_image.php" />
            <!--img src="<?php echo base_url(); ?>assets/frontend/img/capcha.jpg"/-->
        </div>
        <input class="txt-contact txt-capcha" name="captcha" type="text"/>
        <a class="refresh-capcha" href="javascript:void(0);">(Gentag billedets kode - Bemærk at der skelnes mellem store og små bogstaver) </a>
        
        <div class="clearfix"></div>
        <input type="submit" class="btn-send" style="border:none; cursor:pointer;" />
        <!--a href="#" class="btn-send">SEND</a-->
    </fieldset>
    </form>
    </div>
    </div>
    </div><!--.contact-->
    </div>
    <!--contentLeft-->
    <?php echo modules::run('banner/banner/index'); ?>
    <!--adsRight-->
    <div class="clear"></div>
</div>
<script>
jQuery(document).ready(function(){
	//jQuery("#help_active").addClass('active');
	});
</script>