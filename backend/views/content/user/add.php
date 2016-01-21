<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<script language="javascript">
jQuery(document).ready(function()
{
	jQuery("#addForm").validate({
		rules: {
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
			},
			name: {
				required: true
			},
			code: {
				required: true
			},
			city: {
				required: true
			}			
		}
	});
});// JavaScript Document
</script>
<div class="admin-cnt">
	<div class="btn-admin f-r">
       <a href="javascript:submitButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-save.jpg" alt=""/></a>
       <a href="<?php echo base_url().index_page(); ?>user/close.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form action="<?php echo base_url().index_page(); ?>user/save_add.html" class="frm-profil" method="post" id="addForm" enctype="multipart/form-data">
        <fieldset>
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
        <div class="clearfix">
            <label>Member</label>
            <select name="member" style="margin-bottom:10px; height:26px;">
            	<option value="1">Silver</option>
                <option value="2">Gold</option>
            </select>
        </div>
        <div class="clearfix">
            <label>Name*</label>
            <input type="text" class="input-profil" name="name" id="name" value="" />
        </div>
        <div class="clearfix">
            <label>Gender</label>
            <select name="gender" style="margin-bottom:10px; height:26px;">
            	<option value="0">Female</option>
                <option value="1">Male</option>
            </select>
        </div>
        <div class="clearfix">
            <label>Zip code*</label>
            <input type="text" class="input-profil" name="code" id="code" value="" style="width:50px;" maxlength="4" />
        </div>
        <div class="clearfix">
            <label>City*</label>
            <input type="text" class="input-profil" name="city" id="city" value="" />
        </div>
        <div class="clearfix">
            <label>Birthday*</label>
            Day&nbsp;
            <select name="day" style="margin-bottom:10px; height:26px;">
            	<?php for($i = 1; $i <= 31; $i++){?> 
            	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }?>
            </select>
            &nbsp;Month&nbsp;
            <select name="month" style="margin-bottom:10px; height:26px;">
            	<?php for($i = 1; $i <= 12; $i++){?>
            	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }?>
            </select>
            &nbsp;Year&nbsp;
            <select name="year" style="margin-bottom:10px; height:26px;">
            	<?php for($i = 1900; $i <= 2013; $i++){?>
            	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }?>
            </select>
        </div>
        <div class="clearfix">
            <label>Height</label>
            <input type="text" class="input-profil" name="height" id="height" value="" style="width:50px;" /> <span style="line-height:26px;">&nbsp;cm</span>
        </div>
        <div class="clearfix">
            <label>Weight</label>
            <input type="text" class="input-profil" name="weight" id="weight" value="" style="width:50px;" /> <span style="line-height:26px;">&nbsp;kg</span>
        </div>
        <div class="clearfix">
            <label>I am a</label>
            <select name="own" style="margin-bottom:10px; height:26px;">
            	<option value="1">Sugar baby male</option>
                <option value="2">Sugar baby female</option>
                <option value="3">Sugar dad</option>
                <option value="4">Sugar mom</option>
            </select>
        </div>
        <div class="clearfix">
            <label>I play with a</label>
            <select name="play" style="margin-bottom:10px; height:26px;">
            	<option value="1">Sugar baby male</option>
                <option value="2">Sugar baby female</option>
                <option value="3">Sugar dad</option>
                <option value="4">Sugar mom</option>
            </select>
        </div>
        <div class="clearfix">
            <label>Avatar</label>
            <input type="file" name="avatar" id="avatar" style="margin-bottom:10px; height:26px; background:none !important;" />
        </div>
        <div class="clearfix">
            <label>Status</label>
            <textarea name="status" cols="35" rows="10" style="margin-bottom:10px;"></textarea>
        </div>
        <div class="clearfix">
            <label>Status permission</label>
            <select name="status_permission" style="margin-bottom:10px; height:26px;">
            	<option value="1">All</option>
                <option value="2">My friends</option>
            </select>
        </div>
        <div class="clearfix">
            <label>Slogan</label>
            <input type="text" class="input-profil" name="slogan" id="slogan" value="" />
        </div>
        <div class="clearfix">
            <label>Description</label>
            <textarea name="description" cols="35" rows="10"></textarea>
        </div>
        <div class="clearfix">
            <label>Who can see</label>
            <select name="see_profile" style="margin-bottom:10px; height:26px;">
            	<option value="1">All member</option>
                <option value="2">Their friends</option>
            </select>
        </div>
        <input type="submit" id="submitButton" style="display:none;" />
        </fieldset>
    </form>
</div>