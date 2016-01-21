<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/ckeditor/ckeditor.js"></script>
<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/css/jquery.ui.all.css"/>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.ui.widget.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/datepicker.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery.ui.datepicker-da.js"></script>
<script language="javascript">
jQuery(document).ready(function()
{
	jQuery("#addForm").validate({
		rules: {
			name: {
				required: true,
			},description: {
				required: true,
			},old_price: {
				required: true,
			},new_price: {
				required: true,
			},quantity: {
				required: true,
			},date: {
				required: true,
			}
		}
	});
    
    $("#date").datepicker({
        changeMonth: true,
        changeYear: true
    });	
});// JavaScript Document
</script>
<div class="admin-cnt">
	<div class="btn-admin f-r">
       <a href="javascript:submitButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-save.jpg" alt=""/></a>
       <a href="<?php echo base_url().index_page(); ?>deal/close.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form action="<?php echo base_url().index_page(); ?>deal/save_add.html" class="frm-profil" method="post" id="addForm" enctype="multipart/form-data">
        <fieldset>
        <div class="clearfix">
            <label>Name*</label>
            <input type="text" class="input-profil" name="name" id="name" value="" />
        </div>
        <div class="clearfix">
            <label>Company*</label>
            <select name="b2b_id" class="input-profil">
            <?php foreach($b2bs as $b2b){?>
            	<option value="<?php echo $b2b->id;?>"><?php echo $b2b->company.' ('.$b2b->email.')';?></option>
            <?php }?>
            </select>
        </div>
        <div class="clearfix">
            <label>Category*</label>
            <select name="category_id" class="input-profil">
            <?php foreach($categories as $category){?>
            	<option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
            <?php }?>
            </select>
        </div>
        <div class="clearfix">
            <label>Title*</label>
            <div class="input-profil" style="background:none; border:none;">
                <textarea name="title" style="width: 244px; height: 100px;"></textarea>
            </div>
        </div>
        <div class="clearfix">
            <label>Description*</label>
            <div class="input-profil" style="background:none; border:none;">
            <?php
				$this->ckeditor->config['height'] = 200;
				$this->ckeditor->config['width'] = 600;
				$this->ckeditor->editor('description');
			?>
            </div>
        </div>
        <div class="clearfix">
            <label>Old price*</label>
            <input type="text" class="input-profil" name="old_price" id="old_price" value="" style="width:100px" />
            <span style="float:left; line-height:30px;">&nbsp;&nbsp;DKK</span>
        </div>
        <div class="clearfix">
            <label>New price*</label>
            <input type="text" class="input-profil" name="new_price" id="new_price" value="" style="width:100px" />
            <span style="float:left; line-height:30px;">&nbsp;&nbsp;DKK</span>
        </div>
        <div class="clearfix">
            <label>Quantity*</label>
            <input type="text" class="input-profil" name="quantity" id="quantity" value="" style="width:100px" />
        </div>
        <div class="clearfix">
            <label>End time*</label>
            <select name="hour" class="input-profil" style="width:50px;">
                <?php for($i=0; $i<24; $i++){ ?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>   
                <?php }?>
            </select> 
            <span style="float:left; line-height:30px;">&nbsp;&nbsp;hour&nbsp;&nbsp;</span>
            <select name="minute" class="input-profil" style="width:50px;">
                <?php for($i=0; $i<46; $i=$i+15){ ?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>   
                <?php }?>
            </select>
            <span style="float:left; line-height:30px;">&nbsp;&nbsp;minute&nbsp;&nbsp;</span>
            <input type="text" class="input-profil" name="date" id="date" value="" style="width:100px" />
        </div>
        <div class="clearfix">
            <label>Image 1</label>
            <input type="file" name="image1" id="image1" style="margin-bottom:10px; height:26px; background:none !important;" />
        </div>
        <div class="clearfix">
            <label>Image 2</label>
            <input type="file" name="image2" id="image2" style="margin-bottom:10px; height:26px; background:none !important;" />
        </div>
        <div class="clearfix">
            <label>Image 3</label>
            <input type="file" name="image3" id="image3" style="margin-bottom:10px; height:26px; background:none !important;" />
        </div>
        <div class="clearfix">
            <label>Image 4</label>
            <input type="file" name="image4" id="image4" style="margin-bottom:10px; height:26px; background:none !important;" />
        </div>
        <input type="submit" id="submitButton" style="display:none;" />
        </fieldset>
    </form>
</div>