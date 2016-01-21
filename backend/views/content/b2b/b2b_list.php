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
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form id="searchForm" action="<?php echo base_url().index_page(); ?>b2b/search.html" method="post" class="ad-search">
        <fieldset>
          <div class="f-l">
            <label>Filter</label>
            <input type="text" name="keyword" value="<?php echo $this->input->get('keyword')?$this->input->get('keyword'):'';?>" class="txt-find"/>
          </div>
          <input type="submit" value="Search" class="editUser f-l" />
        </fieldset>
    </form>
    <form method="post" id="dealForm" action="<?php echo base_url().index_page(); ?>deal/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td width="10%"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td width="15%">Name</td>
            <td width="15%">Company</td>
            <td width="30%">Date & Time</td>
            <td width="10%">Number</td>
            <td width="20%">&nbsp;</td>
        </tr>
        <?php if($deals){ foreach($deals as $rows){
			$link = "b2b/edit/".$rows['id'].".html";	
		?>
        <tr>
            <td><input type="checkbox" value="<?php echo $rows['id'];?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><?php echo $rows['name'];?></td>
            <td><?php echo $rows['company'];?></td>
            <td>
                <?php echo date("d-m-Y", $rows['time']);?> til: <?php echo date("d-m-Y", $rows['end_date']);?>
            </td>
            
            <td><?php echo $rows['quantity']->quantity;?></td>
            <td><a href="<?php echo $link;?>">View sold</a></td>
            
        </tr>
        <?php }}?>
   	</table>
    <input type="submit" style="display:none" id="submitButton" />
    </form>
    <div class="pagging2 clear">
        <div class="f-l m-l130">
        <form action="<?php echo base_url().index_page(); ?>common/change_num.html" method="post">
          <label>view per page</label>
          <input type="text" value="<?php echo get_item_per_page();?>" class="txt" name="item_per_page" maxlength="2">
          <input type="submit" class="bntSelect f-r" value="Vælg" />
          <input type="hidden" name="return" value="/deal" />
        </form>
        </div>
        <?php echo $all_link;?>
    </div>
</div>