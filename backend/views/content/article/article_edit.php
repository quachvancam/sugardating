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
	$("#category_id").val('<?php echo $article->category_id;?>').prop('selected',true);
});// JavaScript Document
</script>
<div class="admin-cnt">
	<div class="btn-admin f-r">
       <a href="javascript:submitButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-save.jpg" alt=""/></a>
       <a href="<?php echo base_url().index_page(); ?>article/close.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <!--<form action="<?php echo base_url().index_page(); ?>article/save_edit.html" class="frm-profil" method="post" id="addForm" enctype="multipart/form-data">-->
    <?php echo form_open('article/save_edit', array('id'=>'addForm', 'class'=>'frm-profil', 'method'=>'post', 'enctype'=>'multipart/form-data'))?>
        <fieldset>
        <div class="clearfix">
            <label>Title*</label>
            <input type="text" class="input-profil" name="title" id="title" value="<?php echo $article->title;?>" />
        </div>
        <div class="clearfix">
            <label>Category*</label>
            <select name="category_id" class="input-profil" id="category_id">
            <?php foreach($categories as $category){?>
            	<option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
            <?php }?>
            </select>
        </div>
        <div class="clearfix">
            <label>Image*</label>
            <?php if($article->image){?>
            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().'upload/news/'.$article->image.'&q=100&h=70'; ?>" />
            <?php }?>
            <input type="file" name="image" id="image" style="margin-bottom:10px; height:26px; background:none !important;" />
        </div>
        <div class="clearfix">
            <label>Short content*</label>
            <div class="input-profil" style="background:none; border:none;">
            <?php
				$this->ckeditor->config['height'] = 200;
				$this->ckeditor->config['width'] = 500;
				//$this->ckeditor->config['toolbar'] = 'Basic';
				//unset($this->ckeditor->config['toolbar']);
				$this->ckeditor->editor('short_content', $article->short_content);
			?>
            </div>
        </div>
        <div class="clearfix">
            <label>Full content*</label>
            <div class="input-profil" style="background:none; border:none;">
             <?php
				$this->ckeditor->config['height'] = 200;
				$this->ckeditor->config['width'] = 500;
				//unset($this->ckeditor->config['toolbar']);
				$this->ckeditor->editor('full_content', $article->full_content);
			?>
            </div>
        </div>
        <input type="submit" id="submitButton" style="display:none;" />
        <input type="hidden" name="id" value="<?php echo $article->id;?>" />
        </fieldset>
    </form>
</div>