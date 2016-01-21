<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/ckeditor/ckeditor.js"></script>
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
       <a href="<?php echo base_url().index_page(); ?>blog/close/<?php echo $this->uri->segment(3);?>.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form action="<?php echo base_url().index_page(); ?>blog/save_edit.html" class="frm-profil" method="post" id="addForm" enctype="multipart/form-data">
        <fieldset>
        <div class="clearfix">
            <label>Title*</label>
            <input type="text" class="input-profil" name="title" id="title" value="<?php echo $blog->title;?>" />
        </div>
        <div class="clearfix">
            <label>Image*</label>
            <?php if($blog->image){?>
            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().'upload/blog/'.$blog->image.'&q=100&h=70'; ?>" />
            <?php }?>
            <input type="file" name="image" id="image" style="margin-bottom:10px; height:26px; background:none !important;" />
        </div>
        <div class="clearfix">
            <label>Content*</label>
            <div class="input-profil" style="background:none; border:none;">
            <?php
				$this->ckeditor->config['height'] = 200;
				$this->ckeditor->config['width'] = 500;
				$this->ckeditor->editor('content', $blog->content);
			?>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $this->uri->segment(4);?>" />
        <input type="hidden" name="user_id" value="<?php echo $user_id;?>" />
        <input type="submit" id="submitButton" style="display:none;" />
        </fieldset>
    </form>
</div>