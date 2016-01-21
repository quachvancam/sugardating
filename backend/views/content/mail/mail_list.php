<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<style>
.table-admin td{
    text-align:center;
}
</style>
<div class="ad-content">
  	<div class="btn-admin f-r">
        <a href="<?php echo base_url().index_page(); ?>mail/add.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a>
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form method="post" id="mailForm" action="<?php echo base_url().index_page(); ?>mail/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td width="5%"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td width="80%"><a href="#">Name</a></td>
            <td width="15%">Publish</td>
        </tr>
        <?php foreach($mails as $mail){
			$link = "mail/edit/".$mail->id.".html";	
		?>
        <tr>
            <td><input type="checkbox" value="<?php echo $mail->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><a href="<?php echo $link;?>"><?php echo $mail->title;?></a></td>
            <td><img src="<?php echo base_url(); ?>assets/backend/img/<?php echo $mail->publish?'iconcheck1.png':'iconClose2.png';?>" onclick="publish('mail_template', <?php echo $mail->id;?>, <?php echo $mail->publish? 0 : 1;?>)" style="cursor:pointer;" /></td>
        </tr>
        <?php }?>
   	</table>
    <input type="submit" style="display:none" id="submitButton" />
    </form>
</div>