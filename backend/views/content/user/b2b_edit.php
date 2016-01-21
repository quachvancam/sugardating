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
			company: {
				required: true
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
        <a href="<?php echo base_url().index_page(); ?>b2b_user/close.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form action="<?php echo base_url().index_page(); ?>b2b_user/save_edit.html" class="frm-profil" method="post" id="editForm" enctype="multipart/form-data">
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
            <label>Image*</label>
            <?php if($user->image){?>
            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().'upload/b2b/'.$user->image.'&q=100&h=70'; ?>" />
            <?php }?>
            <input type="file" name="image" id="image" style="margin-bottom:10px; height:26px; background:none !important;" />
        </div>
        <div class="clearfix">
            <label>Link</label>
            <input type="text" class="input-profil" name="web" id="web" value="<?php echo $user->web;?>"/>
        </div>
        <div class="clearfix">
            <label>Company*</label>
            <input type="text" class="input-profil" name="company" id="company" value="<?php echo $user->company;?>" />
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