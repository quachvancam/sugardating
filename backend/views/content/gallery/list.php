<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<div class="ad-content">
  	<div class="btn-admin f-r">
        <a href="<?php echo base_url().index_page(); ?>gallery/add/<?php echo $this->uri->segment(3);?>.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a>
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
        <a href="<?php echo base_url().index_page(); ?>user.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form method="post" id="galleryForm" action="<?php echo base_url().index_page(); ?>gallery/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td class="w10"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td class="w50">Image</td>
            <td class="w50">Publish</td>
        </tr>
        <?php foreach($images as $image){?>
        <tr>
            <td><input type="checkbox" value="<?php echo $image->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().'upload/gallery/'.$image->image.'&q=100&h=100'; ?>" /></td>
            <td><img src="<?php echo base_url(); ?>assets/backend/img/<?php echo $image->publish?'iconcheck1.png':'iconClose2.png';?>" onclick="publish('gallery', <?php echo $image->id;?>, <?php echo $image->publish? 0 : 1;?>, '<?php echo base_url().index_page().'common/publish'; ?>')" style="cursor:pointer;" /></td>
        </tr>
        <?php }?>
   	</table>
    <input type="hidden" name="user_id" value="<?php echo $this->uri->segment(3);?>" />
    <input type="submit" style="display:none" id="submitButton" />
    </form>
    <div class="pagging2 clear">
        <div class="f-l m-l130">
        <form action="<?php echo base_url().index_page(); ?>common/change_num.html" method="post">
          <label>view per page</label>
          <input type="text" value="<?php echo get_item_per_page();?>" class="txt" name="item_per_page" maxlength="2"/>
          <input type="submit" class="bntSelect f-r" value="Vælg" />
          <input type="hidden" name="return" value="gallery/index/<?php echo $this->uri->segment(3);?>" />
        </form>
        </div>
        <?php echo $all_link;?>
    </div>
</div>