<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<script language="javascript">
jQuery(document).ready(function()
{
	jQuery("#addForm").validate({
		rules: {
			title: {
				required: true,
			}
		}
	});
});// JavaScript Document
</script>
<div class="admin-cnt">
	<div class="btn-admin f-r">
       <a href="javascript:submitButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-save.jpg" alt=""/></a>
       <a href="<?php echo base_url().index_page(); ?>banner/close.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form action="<?php echo base_url().index_page(); ?>banner/save_edit.html" class="frm-profil" method="post" id="editForm" enctype="multipart/form-data">
        <fieldset>
        <div class="clearfix">
            <label>Title*</label>
            <input type="text" class="input-profil" name="title" id="title" value="<?php echo $banner->title;?>" />
        </div>
        <div class="clearfix">
            <label>Link path*</label>
            <input type="text" class="input-profil" name="link_path" id="link_path" value="<?php echo $banner->link_path;?>" />
        </div>
        <div class="clearfix">
            <label>Image*</label>
            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().'upload/banner/'.$banner->image.'&q=100&h=70'; ?>" />
            <input type="file" name="image" id="image" style="margin-bottom:10px; height:26px; background:none !important;" />
        </div>
        <input type="hidden" name="id" value="<?php echo $banner->id;?>" />
        <input type="submit" id="submitButton" style="display:none;" />
        </fieldset>
    </form>
</div>