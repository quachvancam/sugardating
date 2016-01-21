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
<div id="sugarDates" class="clearfix bgContent m-t-3">
    <div class="contentLeft">
    <div>
          <a class="f-r" href="<?php echo base_url().index_page(); ?>b2b/index.html">
          	 <img src="<?php echo base_url(); ?>assets/frontend/img/btn-back.jpg" alt=""/>
          </a>
    </div>
    <div class="clearfix"></div>
    <table class="b2b">
    	<tr class="b2b-title">
    		<td>Faktura nr.</td>
    		<td>Dato & tid</td>
    		<!--td>Kundens navn</td-->
    		<td>Antal bestilt</td>
    		<td>Varens navn</td>
    		<td>Beløb</td>
    		<td colspan="2">Ref. numre</td>
    	</tr>
        <?php if($deal){foreach($deal as $rows){?>
    	<tr>
    		<td><?php echo $rows->orderID;?></td>
    		<td><?php echo date("d-m-Y", $rows->times);?></td>
    		<!--td><?php echo $rows->customer;?></td-->
    		<td class="txt-center"><?php echo $rows->quantity;?></td>
    		<td><?php echo $rows->name;?></td>
    		<td><?php echo priceFormat($rows->new_price);?></td>
    		<td class="no-boder-r pr0">
    			<p><?php echo $rows->codes;?></p>
    		</td>
    		<td>
    			<p><input id="checkOK_<?php echo $rows->id;?>" value="<?php echo $rows->id;?>" onclick="checkB2B('<?php echo $rows->id;?>');" <?php if($rows->status){echo 'checked="true"  disabled="true"';}?> type="checkbox" /></p>
    		</td>
    	</tr>
        <?php }}?>
    
    </table>
    </div>
    <?php echo modules::run('banner/banner/index'); ?>
</div>
<?php echo modules::run('shop/shop/index'); ?>