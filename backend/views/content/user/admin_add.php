<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<script language="javascript">
jQuery(document).ready(function()
{
	jQuery("#addForm").validate({
		rules: {
			name: {
				required: true,
			},
			email: {
				required: true,
				email: true
			}, 
			pass: {
				required: true,
				minlength: 6
			},
			confirm_pass: {
				equalTo: "#pass"
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
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form action="<?php echo base_url().index_page(); ?>admin_user/save_add.html" class="frm-profil" method="post" id="addForm">
        <fieldset>
        <div class="clearfix">
            <label>Name*</label>
            <input type="text" class="input-profil" name="name" id="name" value="" />
        </div>
        <div class="clearfix">
            <label>Email*</label>
            <input type="text" class="input-profil" name="email" id="email" value="" />
        </div>
        <div class="clearfix">
            <label>Password*</label>
            <input type="password" class="input-profil" name="pass" id="pass" />
        </div>
        <div class="clearfix">
            <label>Confirm password*</label>
            <input type="password" class="input-profil" name="confirm_pass" id="confirm_pass" />
        </div>
        <input type="submit" id="submitButton" style="display:none;" />
        </fieldset>
    </form>
</div>