<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<script language="javascript">
jQuery(document).ready(function()
{
	jQuery("#editForm").validate({
		rules: {
			name: {
				required: true,
			},
			email: {
				required: true,
				email: true
			}, 
			confirm_pass: {
				equalTo: "#new_pass"
			}
		},
		messages: {
			email: "",
			name: ""
		}
	});
});// JavaScript Document
</script>
<div class="admin-cnt">
	<div class="btn-admin f-r">
        <a href="javascript:submitButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-save.jpg" alt=""/></a>
        <a href="<?php echo base_url().index_page(); ?>admin_user/close.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
     </div>
    <form action="<?php echo base_url().index_page(); ?>admin_user/save_edit.html" class="frm-profil" method="post" id="editForm">
        <fieldset>
        <div class="clearfix">
            <label>Name*</label>
            <input type="text" class="input-profil" name="name" id="name" value="<?php echo $user->name;?>" />
        </div>
        <div class="clearfix">
            <label>Email*</label>
            <input type="text" class="input-profil" name="email" id="email" value="<?php echo $user->email;?>" <?php echo $user->email ? 'readonly="readonly"' : ''?> />
        </div>
        <div class="clearfix">
            <label>New password</label>
            <input type="password" class="input-profil" name="new_pass" id="new_pass" />
        </div>
        <div class="clearfix">
            <label>Confirm new password</label>
            <input type="password" class="input-profil" name="confirm_pass" id="confirm_pass" />
        </div>
        </fieldset>
        <input type="hidden" name="id" value="<?php echo $user->id;?>" />
        <input type="submit" id="submitButton" style="display:none;" />
    </form>
</div>