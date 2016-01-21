<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<script language="javascript">
jQuery(document).ready(function()
{
	jQuery("#addForm").validate({
		rules: {
			name: {
				required: true,
			},
			config: {
				required: true,
			},
			value: {
				required: true,
			}
		}
	});
});// JavaScript Document
</script>
<div class="ad-content">
	<div class="btn-admin f-r">
       <a href="javascript:submitButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-save.jpg" alt=""/></a>
       <a href="<?php echo base_url().index_page(); ?>config/close.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form action="<?php echo base_url().index_page(); ?>config/save_add.html" class="frm-profil" method="post" id="addForm">
        <fieldset>
        <div class="clearfix">
            <label>Name*</label>
            <input type="text" class="input-profil" name="name" id="name" value="" />
        </div>
        <div class="clearfix">
            <label>Config*</label>
            <input type="text" class="input-profil" name="config" id="config" value="" />
        </div>
        <div class="clearfix">
            <label>Value*</label>
            <input type="text" class="input-profil" name="value" id="value" value="" />
        </div>
        <input type="submit" id="submitButton" style="display:none;" />
        </fieldset>
    </form>
</div>