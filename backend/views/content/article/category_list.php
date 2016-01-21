<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<div class="ad-content">
  	<div class="btn-admin f-r">
        <a href="<?php echo base_url().index_page(); ?>category/add.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a>
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form method="post" id="categoryForm" action="<?php echo base_url().index_page(); ?>category/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td class="w10"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td class="w50"><a href="#">Name</a></td>
            <td class="w50"><a href="#">Alias</a></td>
            <td class="w50">Created</td>
            <td class="w50">Publish</td>
        </tr>
        <?php foreach($categories as $category){
			$link = "category/edit/".$category->id.".html";	
		?>
        <tr>
            <td><input type="checkbox" value="<?php echo $category->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><a href="<?php echo $link;?>"><?php echo $category->name;?></a></td>
            <td><?php echo $category->alias;?></td>
            <td><?php echo myfull_date($category->time);?></td>
            <td><img src="<?php echo base_url(); ?>assets/backend/img/<?php echo $category->publish?'iconcheck1.png':'iconClose2.png';?>" onclick="publish('category', <?php echo $category->id;?>, <?php echo $category->publish? 0 : 1;?>)" style="cursor:pointer;" /></td>
        </tr>
        <?php }?>
   	</table>
    <input type="submit" style="display:none" id="submitButton" />
    </form>
    <div class="pagging2 clear">
        <div class="f-l m-l130">
        <form action="<?php echo base_url().index_page(); ?>common/change_num.html" method="post">
          <label>view per page</label>
          <input type="text" value="<?php echo get_item_per_page();?>" class="txt" name="item_per_page" maxlength="2">
          <input type="submit" class="bntSelect f-r" value="Vælg" />
          <input type="hidden" name="return" value="/category" />
        </form>
        </div>
        <?php echo $all_link;?>
    </div>
</div>