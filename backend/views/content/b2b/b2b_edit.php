<script type="text/javascript">
function checkB2B(id){
    $.ajax({
    	type: 'post',
    	url: '<?php echo base_url().index_page();?>b2b/updatedeal.html',
        data: {id: id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
    	success:function (result){
            $("#checkOK_"+id).attr( "disabled", true );
    	}			
    });
}
</script>
<div class="admin-cnt">
	<div class="btn-admin f-r">
       <a href="<?php echo base_url().index_page(); ?>b2b/close.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <table class="table-admin">
        <tr class="titleSearch">
            <td>Order No.</td>
    		<td>Date & Time</td>
    		<td>Customer Name</td>
    		<td>Number</td>
    		<td>Category</td>
    		<td>Amount</td>
    		<td>Reference numbers</td>
            <td style="text-align: center;">Used</td>
        </tr>
        <?php if($deal){foreach($deal as $rows){?>
    	<tr>
    		<td><?php echo $rows->orderID;?></td>
    		<td><?php echo date("d-m-Y", $rows->times);?></td>
    		<td><?php echo $rows->customer;?></td>
    		<td class="txt-center"><?php echo $rows->quantity;?></td>
    		<td><?php echo $rows->name;?></td>
    		<td><?php echo number_format($rows->new_price,2,",",".");?></td>
    		<td class="no-boder-r pr0">
    			<p><?php echo $rows->codes;?></p>
    		</td>
    		<td style="text-align: center;">
    			<p><input id="checkOK_<?php echo $rows->id;?>" value="<?php echo $rows->id;?>" onclick="checkB2B('<?php echo $rows->id;?>');" <?php if($rows->status){echo 'checked="true"  disabled="true"';}?> type="checkbox" /></p>
    		</td>
    	</tr>
        <?php }}?>
   	</table>
</div>