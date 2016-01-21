<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<div class="ad-content">
  	<div class="btn-admin f-r">
        <a href="<?php echo base_url().index_page(); ?>admin_user/add.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a>
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form method="post" id="adminForm" action="<?php echo base_url().index_page(); ?>admin_user/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td class="w10"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td class="w20p"><a href="#">Name <img src="<?php echo base_url(); ?>assets/backend/img/arrow-sort.png" alt=""/></a></td>
            <td class="w50">Email</td>
            <td class="w20">Last login</td>
            <td class="w20">Publish</td>
        </tr>
        <?php foreach($users as $user){
			$link = "admin_user/edit/".$user->id;	
		?>
        <tr>
            <td><input type="checkbox" value="<?php echo $user->id;?>" class="checkadmin" name="adminid[]" style="width:10px !important" /></td>
            <td><a href="<?php echo $link;?>"><?php echo $user->name;?></a></td>
            <td><?php echo $user->email;?></td>
            <td><?php echo myfull_date($user->last_login);?></td>
            <td class="w20"><img src="<?php echo base_url(); ?>assets/backend/img/<?php echo $user->publish?'iconcheck1.png':'iconClose2.png';?>" onclick="publish('admin', <?php echo $user->id;?>, <?php echo $user->publish? 0 : 1;?>)" style="cursor:pointer;" /></td>
        </tr>
        <?php }?>
   	</table>
    <input type="submit" style="display:none" id="submitButton" />
    </form>
</div>