<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/ckeditor/ckeditor.js"></script>
<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/css/jquery.ui.all.css"/>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.ui.widget.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/datepicker.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery.ui.datepicker-da.js"></script>

<div class="admin-cnt">
	<div class="btn-admin f-r">
       <!--a href="javascript:submitButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-save.jpg" alt=""/></a-->
       <a href="<?php echo base_url().index_page(); ?>order/close.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <div class="frm-profil">
        <div class="clearfix">
            <label>Order ID</label>
            <p><?php echo $order->orderID;?></p>
        </div>
        <div class="clearfix">
            <label>Customer Name</label>
            <p><?php echo $order->name;?></p>
        </div>
        <div class="clearfix">
            <label>Email</label>
            <p><?php echo $order->email;?></p>
        </div>
        <div class="clearfix">
            <label>Address</label>
            <p><?php echo $order->code." ".$order->city;?></p>
        </div>
        <div class="clearfix">
            <label>Date Added</label>
            <p><?php echo date("H:i d-m-Y", $order->time);?></p>
        </div>
        <div class="clearfix">
            <label>Total</label>
            <p><?php echo $order->total;?> DKK</p>
        </div>
        <div class="clearfix">
            <label>Status</label>
            <p><?php if($order->status){echo "Complete";}else{echo "Pending";}?></p>
        </div>
    </div>
    <div style="margin: 20px 20px 20px 0;">
        <table class="table-admin">
            <tr class="titleSearch">
                <td width="15%">Name</td>
                <td width="20%">Description</td>
                <td width="20%">Image</td>
                <td width="7%">Price</td>
                <td width="7%">Price</td>
                <td width="10%">End time</td>
                <td width="5%">Quantity</td>
                <td width="15%">Value Code</td>
            </tr>
            <?php if($items){foreach($items as $rows){?>
            <tr>
                <td><?php echo $rows->name;?></td>
                <td><?php echo $rows->description;?></td>
                <td>
                    <div class="border-right" style="margin: 0; padding: 0; position: relative; width: 221px; height:120px; float:left;">
                        <img src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $rows->image1; ?>&h=120&w=220&zc=1" />
                        <span style="display: block;position: absolute;right: 10px;top: 10px;">
                            <img src="<?php echo base_url(); ?>upload/deal_category/<?php echo $rows->red_icon; ?>" alt=""/>
                        </span>
                    </div>
                </td>
                <td><?php echo $rows->old_price;?> DKK</td>
                <td><?php echo $rows->new_price;?> DKK</td>
                <td><?php echo date("H:i d-m-Y", $rows->time);?></td>
                <td><?php echo $rows->quantity;?></td>
                <td><?php echo $rows->codes;?></td>
            </tr>
            <?php }}?>
       	</table>
    </div>
</div>