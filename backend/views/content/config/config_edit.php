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
<div class="admin-cnt">
	<div class="btn-admin f-r">
        <a href="javascript:submitButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-save.jpg" alt=""/></a>
        <a href="<?php echo base_url().index_page(); ?>config/close.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
     </div>
    <form action="<?php echo base_url().index_page(); ?>config/save_edit.html" class="frm-profil" method="post" id="editForm">
        <fieldset>
        <div class="clearfix">
            <label>Name*</label>
            <input type="text" class="input-profil" name="name" id="name" value="<?php echo $config->name;?>" />
        </div>
        <div class="clearfix">
            <label>Config*</label>
            <input type="text" class="input-profil" name="config" id="config" value="<?php echo $config->config;?>" />
        </div>
        <div class="clearfix">
            <label>Value*</label>
            <input type="text" class="input-profil" name="value" id="value" value="<?php echo $config->value;?>" />
        </div>
        </fieldset>
        <input type="hidden" name="id" value="<?php echo $config->id;?>" />
        <input type="submit" id="submitButton" style="display:none;" />
    </form>
</div>