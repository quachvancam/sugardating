<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<style>
.table-admin td{
    text-align:center;
    border:1px solid black;
}
</style>
<div class="ad-content">
  	<div class="btn-admin f-r">
        <!--a href="<?php echo base_url().index_page(); ?>order/add.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a-->
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form id="searchForm" action="<?php echo base_url().index_page(); ?>order/search.html" method="post" class="ad-search">
        <fieldset>
          <div class="f-l">
            <label>Filter</label>
            <input type="text" name="keyword" value="<?php echo $this->input->get('keyword')?$this->input->get('keyword'):'';?>" class="txt-find">
          </div>
          <input type="submit" value="Search" class="editUser f-l" />
        </fieldset>
    </form>
    <form method="post" id="dealForm" action="<?php echo base_url().index_page(); ?>order/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td width="5%"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td width="15%">Order ID</td>
            <td width="25%">Customer Name</td>
            <td width="10%">Status</td>
            <td width="20%">Date Added</td>
            <td width="15%">Total</td>
            <td width="10%">Action</td>
            <!--td width="5%">Sort <a href="javascript:sortButton('dealForm', '<?php echo base_url().index_page(); ?>common/sort_order.html');"><img src="<?php echo base_url(); ?>assets/backend/img/sort_save.png" alt=""/></a></td-->
        </tr>
        <?php if($order){ foreach($order as $rows){?>
        <tr>
            <td><input type="checkbox" value="<?php echo $rows->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><?php echo $rows->orderID;?></td>
            <td><?php echo $rows->name;?></td>
            <td><?php if($rows->status){echo "Complete";}else{echo "Pending";}?></td>
            <td><?php echo date("H:i d-m-Y", $rows->time);?></td>
            <td><?php echo $rows->total;?> DKK</td>
            <td><a href="<?php echo base_url().index_page(); ?>order/edit/<?php echo $rows->id;?>.html">View detail</a></td>
            <!--td><input type="text" name="ordering[<?php #echo $order->id;?>]" value="<?php #echo $order->ordering?>" style="text-align:center; width:20px;"></td-->
        </tr>
        <?php }}else{?>
        <tr>
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