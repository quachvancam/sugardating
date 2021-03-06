<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<style>
.table-admin td{
    text-align:center;
}
</style>
<div class="ad-content">
  	<div class="btn-admin f-r">
        <a href="<?php echo base_url().index_page(); ?>banner/add.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a>
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form method="post" id="bannerForm" action="<?php echo base_url().index_page(); ?>banner/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td width="5%"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td width="15%">Title</td>
            <td width="25%">Image</td>
            <td width="20%">Link</td>
            <td width="5%">Publish</td>
            <td width="5%">Sort <a href="javascript:sortButton('bannerForm', '<?php echo base_url().index_page(); ?>common/sort_order.html');"><img src="<?php echo base_url(); ?>assets/backend/img/sort_save.png" alt=""/></a></td>
        </tr>
        <?php foreach($banners as $banner){
            $edit_link = "banner/edit/".$banner->id.".html";    
        ?>
        <tr>
            <td><input type="checkbox" value="<?php echo $banner->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><a href="<?php echo $edit_link;?>"><?php echo $banner->title;?></a></td>
            <td><img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().'upload/banner/'.$banner->image.'&q=100&h=100'; ?>" /></td>
            <td><?php echo $banner->link_path;?></td>
            <td><img src="<?php echo base_url(); ?>assets/backend/img/<?php echo $banner->publish?'iconcheck1.png':'iconClose2.png';?>" onclick="publish('banner', <?php echo $banner->id;?>, <?php echo $banner->publish? 0 : 1;?>)" style="cursor:pointer;" /></td>
            <td><input type="text" name="ordering[<?php echo $banner->id;?>]" value="<?php echo $banner->ordering?>" style="text-align:center; width:20px;"></td>
        </tr>
        <?php }?>
   	</table>
    <input type="submit" style="display:none" id="submitButton" />
    <input type="hidden" name="return_url" value="banner" />
    <input type="hidden" name="table" value="banner" />
    </form>
    <div class="pagging2 clear">
        <div class="f-l m-l130">
        <form action="<?php echo base_url().index_page(); ?>common/change_num.html" method="post">
          <label>view per page</label>
          <input type="text" value="<?php echo get_item_per_page();?>" class="txt" name="item_per_page" maxlength="2">
          <input type="submit" class="bntSelect f-r" value="Vælg" />
          <input type="hidden" name="return" value="banner" />
        </form>
        </div>
        <?php echo $all_link;?>
    </div>
</div>