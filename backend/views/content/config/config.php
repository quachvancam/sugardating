<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<div class="ad-content">
  	<div class="btn-admin f-r">
        <a href="<?php echo base_url().index_page(); ?>config/add.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a>
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form method="post" id="configForm" action="<?php echo base_url().index_page(); ?>config/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td class="w10"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td class="w20p"><a href="#">Name</a></td>
            <td class="w50">Key</td>
            <td class="w50">Value</td>
        </tr>
        <?php foreach($configs as $config){
			$link = "config/edit/".$config->id.".html";	
		?>
        <tr>
            <td><input type="checkbox" value="<?php echo $config->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><a href="<?php echo $link;?>"><?php echo $config->name;?></a></td>
            <td><?php echo $config->config;?></td>
            <td><?php echo $config->value;?></td>
        </tr>
        <?php }?>
   	</table>
    <input type="submit" style="display:none" id="submitButton" />
    </form>
</div>