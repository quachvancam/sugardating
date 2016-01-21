<style>
ul.listCard, ul.listCard li{margin:0;padding:10px 0;list-style: none;}
.listCard li{float:left;}
</style>
<div id="sugarDates" class="clearfix bgContent m-t-3">
    <div class="contentLeft">
    <ul class="breakcum">
        <li><a href="<?php echo base_url(); ?>">Start</a></li>
        <li><a href="<?php echo base_url().index_page(); ?>sugarshop/checkout.html">Opret trin 2</a></li>
    </ul>
    <div class="f-step clear">
        <a class="bntStep1" href="<?php echo base_url().index_page(); ?>sugarshop/checkout.html">Trin 1</a>
        <a class="bntStep2a active" href="<?php echo base_url(); ?>">Trin 2</a>
        <div class="clear"></div>
        <div class="f-l m-t10" style="min-height: 400px;">
        	<div style="padding: 10px 0;">
                <p>Du viderestilles nu til PayPal. Nem og sikker betaling. <img style="vertical-align: middle;" src="<?php echo base_url(); ?>assets/frontend/img/loading.gif"/> <a href="https://www.paypal.com/dk/webapps/mpp/logo-center"><img style="vertical-align: middle;" src="<?php echo base_url(); ?>assets/frontend/img/logo_PayPal_dk.png"/></a></p>
            </div>
			<div class="clear"></div>
            <div>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#paypalForm").submit();
                });
                function sendPayment(){
                    $("#paypalForm").submit();
                }
            </script>
            <?php //echo form_open('checkout', array('id'=>'checkout'))?>
            <form id="paypalForm" method="post" action="<?php echo $action;?>">
                <input type="hidden" value="utf-8" name="charset"/>
                <input type="hidden" value="_cart" name="cmd"/>
                <input type="hidden" value="1" name="upload"/>
                <input name="shipping" type="hidden" value="0.00"/>
                <input name="tax" type="hidden" value="0.00"/>
                <?php if($dataPro){$i=1; foreach($dataPro as $rows){?>
                <input type="hidden" value="<?php echo $rows['item_number']?>" name="item_number_<?php echo $i;?>"/>
                <input type="hidden" value="<?php echo $rows['item_name']?>" name="item_name_<?php echo $i;?>"/>
                <input type="hidden" value="<?php echo $rows['amount']?>" name="amount_<?php echo $i;?>"/>
                <input type="hidden" value="<?php echo $rows['quantity']?>" name="quantity_<?php echo $i;?>"/>
                <?php $i++;}}?>
                <input type="hidden" value="<?php echo $amount;?>" name="amount"/>
                <input type="hidden" value="<?php echo $discount_amount_cart;?>" name="discount_amount_cart"/>
                <input type="hidden" value="<?php echo $business;?>" name="business"/>
                <input type="hidden" value="<?php echo $currency_code;?>" name="currency_code"/>
                <input type="hidden" value="<?php echo $email;?>" name="email"/>
                <input type="hidden" value="<?php echo $invoice;?>" name="invoice"/>
                <input type="hidden" value="<?php echo $lc;?>" name="lc"/>
                <input type="hidden" value="<?php echo $return;?>" name="return"/>
                <input type="hidden" value="<?php echo $notify_url;?>" name="notify_url"/>
                <input type="hidden" value="<?php echo $cancel_return;?>" name="cancel_return"/>
                <input type="hidden" value="<?php echo $custom;?>" name="custom"/>
            </form>
            </div>
            
            <div class="clear"></div>
            <!--a class="bntconfirmOrder1" onclick="sendPayment();" href="javascript:void(0);">Til betaling</a-->
        </div>
        <div class="f-r m-t10">
        	
        </div>
    </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?>
    
    <div class="clear"></div>
</div>