<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<style>
.table-admin td{
    text-align:center;
    border:1px solid black;
}
</style>
<div class="ad-content">
  	<div class="btn-admin f-r">
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
        <a href="<?php echo base_url().index_page(); ?>user.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form id="searchForm" action="<?php echo base_url().index_page(); ?>dating/search/<?php echo $userid;?>.html" method="post" class="ad-search">
        <fieldset>
          <div class="f-l">
            <label>Filter</label>
            <input type="text" name="keyword" value="<?php echo $this->input->get('keyword')?$this->input->get('keyword'):'';?>" class="txt-find"/>
          </div>
          <input type="submit" value="Search" class="editUser f-l" />
        </fieldset>
    </form>
    <form method="post" id="dealForm" action="<?php echo base_url().index_page(); ?>dating/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td width="5%"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td width="12%">User</td>
            <td width="13%">Deal</td>
            <td width="15%">Title</td>
            <td width="25%">Description</td>
            <td width="10%">Time</td>
            <td width="10%">Expire</td>
            <td width="10%">Status</td>
        </tr>
        <?php if($dating){ $i=0; foreach($dating as $rows){?>
        <tr>
            <td><input type="checkbox" value="<?php echo $rows->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><?php echo $rows->name;?></td>
            <td><?php echo $deal[$i]['deal'];?></td>
            <td><?php echo $rows->title;?></td>
            <td><?php echo $rows->description;?></td>
            <td><?php echo date("H:i d-m-Y", $rows->time);?></td>
            <td><?php echo date("H:i d-m-Y", $rows->end_date);?></td>
            <td>&nbsp;</td>
            
        </tr>
        <?php $i++; }}else{?>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <?php }?>
   	</table>
    <input type="submit" style="display:none" id="submitButton" />
    <input type="hidden" name="userid" value="<?php echo $userid;?>" />
    </form>
    <div class="pagging2 clear">
        <div class="f-l m-l130">
        <form action="<?php echo base_url().index_page(); ?>common/change_num.html" method="post">
          <label>view per page</label>
          <input type="text" value="<?php echo get_item_per_page();?>" class="txt" name="item_per_page" maxlength="2"/>
          <input type="submit" class="bntSelect f-r" value="Vælg" />
          <input type="hidden" name="return" value="<?php echo base_url().index_page(); ?>order" />
        </form>
        </div>
        <?php echo $all_link;?>
    </div>
</div>