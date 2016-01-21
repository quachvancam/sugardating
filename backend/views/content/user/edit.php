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
			confirm_pass: {
				equalTo: "#pass"
			},
			name: {
				required: true
			},
			address: {
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
	$("#member").val('<?php echo $user->member;?>').prop('selected',true);
	$("#gender").val('<?php echo $user->gender;?>').prop('selected',true);
	$("#day").val('<?php echo $user->day;?>').prop('selected',true);
	$("#month").val('<?php echo $user->month;?>').prop('selected',true);
	$("#year").val('<?php echo $user->year;?>').prop('selected',true);
	$("#own").val('<?php echo $user->own;?>').prop('selected',true);
	$("#play").val('<?php echo $user->play;?>').prop('selected',true);
	$("#status_permission").val('<?php echo $user->status_permission;?>').prop('selected',true);
    $("#see_profile").val('<?php echo $user->see_profile;?>').prop('selected',true);
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
    <form action="<?php echo base_url().index_page(); ?>user/save_edit.html" class="frm-profil" method="post" id="addForm" enctype="multipart/form-data">
        <fieldset>
        <div class="clearfix">
            <label>Email*</label>
            <input type="text" class="input-profil" name="email" id="email" value="<?php echo $user->email;?>" readonly />
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
            <select name="member" id="member" style="margin-bottom:10px; height:26px;">
            	<option value="1">Silver</option>
                <option value="2">Gold</option>
            </select>
        </div>
        <div class="clearfix">
            <label>Name*</label>
            <input type="text" class="input-profil" name="name" id="name" value="<?php echo $user->name;?>" />
        </div>
        <div class="clearfix">
            <label>Gender</label>
            <select name="gender" id="gender" style="margin-bottom:10px; height:26px;">
            	<option value="0">Female</option>
                <option value="1">Male</option>
            </select>
        </div>
        <div class="clearfix">
            <label>Zip code*</label>
            <input type="text" class="input-profil" name="code" id="code" value="<?php echo $user->code;?>" style="width:50px;" maxlength="4" />
        </div>
        <div class="clearfix">
            <label>City*</label>
            <input type="text" class="input-profil" name="city" id="city" value="<?php echo $user->city;?>" />
        </div>
        <div class="clearfix">
            <label>Birthday*</label>
            Day&nbsp;
            <select name="day" id="day" style="margin-bottom:10px; height:26px;">
            	<?php for($i = 1; $i <= 31; $i++){?> 
            	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }?>
            </select>
            &nbsp;Month&nbsp;
            <select name="month" id="month" style="margin-bottom:10px; height:26px;">
            	<?php for($i = 1; $i <= 12; $i++){?>
            	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }?>
            </select>
            &nbsp;Year&nbsp;
            <select name="year" id="year" style="margin-bottom:10px; height:26px;">
            	<?php
                $yearend = date('Y',time()) - 18;
                $yearstart = date('Y',time()) - 100;
                for($i=$yearstart; $i<=$yearend; $i++){?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }?>
            </select>
        </div>
        <div class="clearfix">
            <label>Height</label>
            <input type="text" class="input-profil" name="height" id="height" value="<?php echo $user->height;?>" style="width:50px;" /> <span style="line-height:26px;">&nbsp;cm</span>
        </div>
        <div class="clearfix">
            <label>Weight</label>
            <input type="text" class="input-profil" name="weight" id="weight" value="<?php echo $user->weight;?>" style="width:50px;" /> <span style="line-height:26px;">&nbsp;kg</span>
        </div>
        <div class="clearfix">
            <label>I am a</label>
            <select name="own" id="own" style="margin-bottom:10px; height:26px;">
            	<option value="1">Sugar baby male</option>
                <option value="2">Sugar baby female</option>
                <option value="3">Sugar dad</option>
                <option value="4">Sugar mom</option>
            </select>
        </div>
        <div class="clearfix">
            <label>I play with a</label>
            <select name="play" id="play" style="margin-bottom:10px; height:26px;">
            	<option value="1">Sugar baby male</option>
                <option value="2">Sugar baby female</option>
                <option value="3">Sugar dad</option>
                <option value="4">Sugar mom</option>
            </select>
        </div>
        <div class="clearfix">
            <label>Avatar</label>
            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().'upload/user/'.$user->avatar.'&q=100&h=70'; ?>" alt="<?php echo $user->name;?>">
            <input type="file" name="avatar" id="avatar" style="margin-bottom:10px; height:26px; background:none !important;" />
            <a href="<?php echo base_url().index_page(); ?>user/delete_avatar/<?php echo $user->id;?>.html">Delete avatar</a>
        </div>
        <div class="clearfix">
            <label>Status</label>
            <textarea name="status" cols="35" rows="10" style="margin-bottom:10px;"><?php echo $user->status;?></textarea>
        </div>
        <div class="clearfix">
            <label>Status permission</label>
            <select name="status_permission" id="status_permission" style="margin-bottom:10px; height:26px;">
            	<option value="1">All</option>
                <option value="2">My friends</option>
            </select>
        </div>
        <div class="clearfix">
            <label>Slogan</label>
            <input type="text" class="input-profil" name="slogan" id="slogan" value="<?php echo $user->slogan;?>" />
        </div>
        <div class="clearfix">
            <label>Description</label>
            <textarea name="description" cols="35" rows="10"><?php echo $user->description;?></textarea>
        </div>
        <div class="clearfix">
            <label>Who can see</label>
            <select name="see_profile" id="see_profile" style="margin-bottom:10px; height:26px;">
            	<option value="1">All member</option>
                <option value="2">Their friends</option>
            </select>
        </div>
        <input type="hidden" name="id" value="<?php echo $user->id;?>" />
        <input type="submit" id="submitButton" style="display:none;" />
        </fieldset>
    </form>
</div>