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
<div class="ad-content">
  	<div class="btn-admin f-r">
        <a href="<?php echo base_url().index_page(); ?>b2b_user/add.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a>
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form id="searchForm" action="<?php echo base_url().index_page(); ?>b2b_user/search.html" method="get" class="ad-search">
        <fieldset>
          <div class="f-l">
            <label>Filter</label>
            <input type="text" name="keyword" value="<?php echo $this->input->get('keyword')?$this->input->get('keyword'):'';?>" class="txt-find">
          </div>
          <input type="submit" value="Search" class="editUser f-l" />
        </fieldset>
    </form>
    <form method="post" id="adminForm" action="<?php echo base_url().index_page(); ?>b2b_user/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td class="w10"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td class="w20p">Profile number</td>
            <td class="w20p"><a href="#">Name <img src="<?php echo base_url(); ?>assets/backend/img/arrow-sort.png" alt=""/></a></td>
            <td class="w50">Email</td>
            <td class="w50">Company</td>
            <td class="w20">Last login</td>
            <td class="w20">Publish</td>
        </tr>
        <?php foreach($users as $user){
			$link = "b2b_user/edit/".$user->id;	
		?>
        <tr>
            <td><input type="checkbox" value="<?php echo $user->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><?php echo $user->id;?></td>
            <td><a href="<?php echo $link;?>"><?php echo $user->name;?></a></td>
            <td><?php echo $user->email;?></td>
            <td><?php echo $user->company;?></td>
            <td><?php echo myfull_date($user->last_login);?></td>
            <td class="w20"><img src="<?php echo base_url(); ?>assets/backend/img/<?php echo $user->publish?'iconcheck1.png':'iconClose2.png';?>" onclick="publish('b2b_user', <?php echo $user->id;?>, <?php echo $user->publish? 0 : 1;?>)" style="cursor:pointer;" /></td>
        </tr>
        <?php }?>
   	</table>
    <input type="submit" style="display:none" id="submitButton" />
    </form>
    <div class="pagging2 clear">
        <div class="f-l m-l130">
        <form action="<?php echo base_url().index_page(); ?>common/change_num.html" method="post">
          <label>vis per side</label>
          <input type="text" value="<?php echo get_item_per_page();?>" class="txt" name="item_per_page" maxlength="2">
          <input type="submit" class="bntSelect f-r" value="Vælg" />
          <input type="hidden" name="return" value="/b2b_user" />
        </form>
        </div>
        <?php echo $all_link;?>
    </div>
    
</div>