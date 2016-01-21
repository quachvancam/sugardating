<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<style>
.table-admin td{
    text-align:center;
    border:1px solid black;
}
</style>
<div class="ad-content">
  	<div class="btn-admin f-r">
        <a href="<?php echo base_url().index_page(); ?>deal/add.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a>
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form id="searchForm" action="<?php echo base_url().index_page(); ?>deal/search.html" method="get" class="ad-search">
        <fieldset>
          <div class="f-l">
            <label>Filter</label>
            <input type="text" name="keyword" value="<?php echo $this->input->get('keyword')?$this->input->get('keyword'):'';?>" class="txt-find">
          </div>
          <input type="submit" value="Search" class="editUser f-l" />
        </fieldset>
    </form>
    <form method="post" id="dealForm" action="<?php echo base_url().index_page(); ?>deal/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td width="5%"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td width="15%">Name</td>
            <td width="20%">Description</td>
            <td width="10%">Category</td>
            <td width="10%">Image</td>
            <td width="15%">Company</td>
            <td width="10%">End date</td>
            <td width="5%">Expiry</td>
            <td width="5%">Publish</td>
            <td width="5%">Sort <a href="javascript:sortButton('dealForm', '<?php echo base_url().index_page(); ?>common/sort_order.html');"><img src="<?php echo base_url(); ?>assets/backend/img/sort_save.png" alt=""/></a></td>
        </tr>
        <?php foreach($deals as $deal){
			$link = "deal/edit/".$deal->id.".html";	
		?>
        <tr>
            <td><input type="checkbox" value="<?php echo $deal->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><a href="<?php echo $link;?>"><?php echo $deal->name;?></a></td>
            <td style="text-align:justify;"><?php echo implode(' ', array_slice(explode(' ', strip_tags($deal->description)), 0, 20)).'...';?></td>
            <td><?php echo $deal->category_name;?></td>
            <td><img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().'upload/deal/'.$deal->image1.'&q=100&w=150&h=100'; ?>" /></td>
            <td><?php echo $deal->company_name;?></td>
            <td><?php echo date("H:i d-m-Y", $deal->end_date);?></td>
            <td><img src="<?php echo base_url(); ?>assets/backend/img/<?php echo $deal->expiry?'iconcheck1.png':'iconClose2.png';?>" onclick="expiry('deal', <?php echo $deal->id;?>, <?php echo $deal->expiry? 0 : 1;?>)" style="cursor:pointer;" /></td>
            <td><img src="<?php echo base_url(); ?>assets/backend/img/<?php echo $deal->publish?'iconcheck1.png':'iconClose2.png';?>" onclick="publish('deal', <?php echo $deal->id;?>, <?php echo $deal->publish? 0 : 1;?>)" style="cursor:pointer;" /></td>
            <td><input type="text" name="ordering[<?php echo $deal->id;?>]" value="<?php echo $deal->ordering?>" style="text-align:center; width:20px;"></td>
        </tr>
        <?php }?>
   	</table>
    <input type="submit" style="display:none" id="submitButton" />
    <input type="hidden" name="return_url" value="deal" />
    <input type="hidden" name="table" value="deal" />
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