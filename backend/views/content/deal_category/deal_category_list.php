<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<style>
.table-admin td{
    text-align:center;
}
</style>
<div class="ad-content">
  	<div class="btn-admin f-r">
        <a href="<?php echo base_url().index_page(); ?>deal_category/add.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a>
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form method="post" id="dealCategoryForm" action="<?php echo base_url().index_page(); ?>deal_category/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td width="5%"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td width="20%">Name</td>
            <td width="25%">White Icon</td>
            <td width="25%">Red Icon</td>
            <td width="15%">Publish</td>
            <td width="10%">Sort <a href="javascript:sortButton('dealCategoryForm', '<?php echo base_url().index_page(); ?>common/sort_order.html');"><img src="<?php echo base_url(); ?>assets/backend/img/sort_save.png" alt=""/></a></td>
        </tr>
        <?php foreach($deal_categories as $deal_category){
            $edit_link = base_url().index_page()."deal_category/edit/".$deal_category->id.".html";    
        ?>
        <tr>
            <td><input type="checkbox" value="<?php echo $deal_category->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><a href="<?php echo $edit_link;?>"><?php echo $deal_category->name;?></a></td>
            <td><img src="<?php echo base_url().'upload/deal_category/'.$deal_category->white_icon; ?>" /></td>
            <td><img src="<?php echo base_url().'upload/deal_category/'.$deal_category->red_icon; ?>" /></td>
            <td><img src="<?php echo base_url(); ?>assets/backend/img/<?php echo $deal_category->publish?'iconcheck1.png':'iconClose2.png';?>" onclick="publish('deal_category', <?php echo $deal_category->id;?>, <?php echo $deal_category->publish? 0 : 1;?>)" style="cursor:pointer;" /></td>
            <td><input type="text" name="ordering[<?php echo $deal_category->id;?>]" value="<?php echo $deal_category->ordering?>" style="text-align:center; width:20px;"></td>
        </tr>
        <?php }?>
   	</table>
    <input type="submit" style="display:none" id="submitButton" />
    <input type="hidden" name="return_url" value="deal_category" />
    <input type="hidden" name="table" value="deal_category" />
    </form>
    <div class="pagging2 clear">
        <div class="f-l m-l130">
        <form action="<?php echo base_url().index_page(); ?>common/change_num.html" method="post">
          <label>view per page</label>
          <input type="text" value="<?php echo get_item_per_page();?>" class="txt" name="item_per_page" maxlength="2">
          <input type="submit" class="bntSelect f-r" value="Vælg" />
          <input type="hidden" name="return" value="deal_category" />
        </form>
        </div>
        <?php echo $all_link;?>
    </div>
</div>