<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<script language="javascript">
jQuery(document).ready(function()
{
	jQuery("#searchForm").validate({
		rules: {
			keyword: {
				required: true,
			}
		}
	});
});// JavaScript Document
</script>
<style>
.table-admin td{
    text-align:center;
}
</style>
<div class="ad-content">
    <div class="btn-admin f-r">
        <a href="<?php echo base_url().index_page(); ?>user/add.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a>
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form id="searchForm" action="<?php echo base_url().index_page(); ?>user/search.html" method="get" class="ad-search">
        <fieldset>
          <div class="f-l">
            <label>Filter</label>
            <input type="text" name="keyword" value="<?php echo $this->input->get('keyword')?$this->input->get('keyword'):'';?>" class="txt-find">
          </div>
          <input type="submit" value="Search" class="editUser f-l" />
        </fieldset>
    </form>
    <form method="post" id="adminForm" action="<?php echo base_url().index_page(); ?>user/delete.html">
    <table class="table-admin">
    <tr class="titleSearch">
        <td width="5%"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
        <td width="5%" ></td>
        <td width="5%" >ID</td>
        <td width="15%">Name</td>
        <td width="10%">Age</td>
        <td width="15%">Height</td>
        <td width="10%">Location</td>
        <td width="10%">Membership</td>
        <td width="10%">Profil status</td>
        <td width="15%">Action</td>
    </tr>
    <?php foreach($users as $user){
		$edit_link = base_url().index_page()."user/edit/".$user->id;
		$gallery_link = base_url().index_page()."gallery/index/".$user->id;
        $blog_link = base_url().index_page()."blog/index/".$user->id;
        $wishlist_link = base_url().index_page()."wishlist/index/".$user->id;
        $dating_link = base_url().index_page()."dating/index/".$user->id;
	?>
    <tr>
        <td><input type="checkbox" value="<?php echo $user->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
        <td style="width:15px;">
            <?php if($user->avatar){?>
            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().'upload/user/'.$user->avatar.'&q=100&h=50'; ?>" alt="<?php echo $user->name;?>"/>
            <?php }else{echo $user->name;}?>
        </td>
        <td><?php echo $user->id;?></td>
        <td><a href="<?php echo $edit_link;?>"><?php echo $user->name;?></a></td>
        <td><?php echo get_age($user->day, $user->month, $user->year);?> yrs old</td>
        <td><?php echo $user->height;?> cm</td>
        <td><?php echo $user->city;?></td>
        <td>
        <?php 
        if($user->member == 2){
            echo "GULD medlem";
        }else if($user->member == 1){
            echo "Sølv medlem";
        }
        else{
            echo "";
        }
        ?>
        </td>
        <td><img src="<?php echo base_url(); ?>assets/backend/img/<?php echo $user->publish?'iconcheck1.png':'iconClose2.png';?>" onclick="publish('user', <?php echo $user->id;?>, <?php echo $user->publish? 0 : 1;?>)" style="cursor:pointer;" /></td>
        <td>
            <a href="<?php echo $edit_link;?>" class="button white" style="float:left;">Edit</a>
            <a href="<?php echo $gallery_link;?>" class="button white" style="float:left;">Gallery</a>
            <a href="<?php echo $blog_link;?>" class="button white" style="float:left;">Blog</a>
            <a href="<?php echo $wishlist_link;?>" class="button white" style="float:left;">Wishlist</a>
            <a href="<?php echo $dating_link;?>" class="button white" style="float:left;">Dating</a>
        </td>
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
          <input type="hidden" name="return" value="/user" />
        </form>
        </div>
        <?php echo $all_link;?>
    </div>
</div>