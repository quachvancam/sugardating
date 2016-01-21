<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<script language="javascript">
jQuery(document).ready(function()
{
	jQuery("#addForm").validate({
		rules: {
			name: {
				required: true,
			}
		}
	});
});// JavaScript Document
</script>
<div class="admin-cnt">
	<div class="btn-admin f-r">
        <a href="javascript:submitButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-save.jpg" alt=""/></a>
        <a href="<?php echo base_url().index_page(); ?>category/close.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
     </div>
    <form action="<?php echo base_url().index_page(); ?>category/save_edit.html" class="frm-profil" method="post" id="editForm">
        <fieldset>
        <div class="clearfix">
            <label>Name*</label>
            <input type="text" class="input-profil" name="name" id="name" value="<?php echo $category->name;?>" />
        </div>
        </fieldset>
        <input type="hidden" name="id" value="<?php echo $category->id;?>" />
        <input type="submit" id="submitButton" style="display:none;" />
    </form>
</div>