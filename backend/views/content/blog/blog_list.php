<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<style>
.table-admin td{
    text-align:center;
}
</style>
<div class="ad-content">
  	<div class="btn-admin f-r">
        <a href="<?php echo base_url().index_page(); ?>blog/add/<?php echo $this->uri->segment(3);?>.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a>
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
        <a href="<?php echo base_url().index_page(); ?>user.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form method="post" id="blogForm" action="<?php echo base_url().index_page(); ?>blog/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td width="5%"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td width="30%">Title</td>
            <td width="40%">Short content</td>
            <td width="15%">Created</td>
            <td width="10%">Publish</td>
        </tr>
        <?php foreach($blogs as $blog){
			$link = base_url().index_page()."blog/edit/".$this->uri->segment(3).'/'.$blog->id.".html";	
		?>
        <tr>
            <td><input type="checkbox" value="<?php echo $blog->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><a href="<?php echo $link;?>"><?php echo $blog->title;?></a></td>
            <td><?php echo implode(' ', array_slice(explode(' ', $blog->content), 0, 10)).'...';?></td>
            <td><?php echo myfull_date($blog->time);?></td>
            <td><img src="<?php echo base_url(); ?>assets/backend/img/<?php echo $blog->publish?'iconcheck1.png':'iconClose2.png';?>" onclick="publish('blog', <?php echo $blog->id;?>, <?php echo $blog->publish? 0 : 1;?>, '<?php echo base_url().index_page().'common/publish'; ?>')" style="cursor:pointer;" /></td>
        </tr>
        <?php }?>
   	</table>
    <input type="submit" style="display:none" id="submitButton" />
    <input type="hidden" name="user_id" value="<?php echo $this->uri->segment(3);?>" />
    </form>
    <div class="pagging2 clear">
        <div class="f-l m-l130">
        <form action="<?php echo base_url().index_page(); ?>common/change_num.html" method="post">
          <label>view per page</label>
          <input type="text" value="<?php echo get_item_per_page();?>" class="txt" name="item_per_page" maxlength="2">
          <input type="submit" class="bntSelect f-r" value="Vælg" />
          <input type="hidden" name="return" value="/blog" />
        </form>
        </div>
        <?php echo $all_link;?>
    </div>
</div>